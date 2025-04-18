<?php

namespace App\Controller;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ChatController extends AbstractController implements MessageComponentInterface
{
    protected $clients;
    protected $userSessions;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->userSessions = [];
    }

    /**
     * @Route("/chat", name="chat_websocket")
     */
    public function chat(): Response
    {
        return new Response(
            '<script>var wsUrl = "' . $this->generateUrl('chat_websocket', [], 0) . '";</script>'
        );
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        $this->userSessions[$conn->resourceId] = [
            'type' => 'user',
            'isAgent' => false
        ];

        echo "Nouvelle connexion! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);
        $response = $this->processMessage($data, $from);

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $client->send(json_encode($response));
            }
        }
    }

    protected function processMessage($data, $from)
    {
        if (!isset($data['type']) || !isset($data['content'])) {
            return [
                'type' => 'error',
                'content' => 'Format de message invalide'
            ];
        }

        // Logique de traitement des messages automatiques
        if (stripos($data['content'], 'devis') !== false) {
            return [
                'type' => 'bot',
                'content' => 'Pour obtenir un devis, veuillez me fournir quelques informations sur votre projet. Quel type de site web souhaitez-vous créer ?'
            ];
        }

        if (stripos($data['content'], 'services') !== false) {
            return [
                'type' => 'bot',
                'content' => 'Nous proposons plusieurs services : création de sites web, développement d\'applications, design UX/UI, et maintenance. Quel service vous intéresse ?'
            ];
        }

        // Message par défaut si aucune correspondance n'est trouvée
        return [
            'type' => 'bot',
            'content' => 'Je vais transférer votre demande à un conseiller. En attendant, n\'hésitez pas à me poser d\'autres questions.'
        ];
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        unset($this->userSessions[$conn->resourceId]);

        echo "Connexion {$conn->resourceId} fermée\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Une erreur est survenue : {$e->getMessage()}\n";
        $conn->close();
    }
}