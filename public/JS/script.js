animation = document.querySelector('#animation');
keyboard_audio = document.querySelector('#keyboard-audio');
sentence_1 = document.querySelector('#sentence_1');
sentence_2 = document.querySelector('#sentence_2');
sentence_3 = document.querySelector('#sentence_3');
sentence_4 = document.querySelector('#sentence_4');
sentence_5 = document.querySelector('#sentence_5');
sentence_6 = document.querySelector('#sentence_6');
sentence_7 = document.querySelector('#sentence_7');
arrow = document.querySelector('#arrow');
arrow1 = document.querySelector('#arrow1');
arrow2 = document.querySelector('#arrow2');
arrow3 = document.querySelector('#arrow3');
arrow4 = document.querySelector('#arrow4');
arrow5 = document.querySelector('#arrow5');
arrow6 = document.querySelector('#arrow6');
arrow7 = document.querySelector('#arrow7');
ml11 = document.querySelector('.ml11');
ml12 = document.querySelector('.ml12');
ml14 = document.querySelector('.ml14');
ml15 = document.querySelector('.ml15');
ml3 = document.querySelector('.ml3');
ml16 = document.querySelector('.ml16');
ml4 = document.querySelector('.ml4');
ml23 = document.querySelector('.ml23');
ml24 = document.querySelector('.ml24');
ml25 = document.querySelector('.ml25');
ml26 = document.querySelector('.ml26');
ml261 = document.querySelector('.ml261');
ml5 = document.querySelector('.ml5');
ml6 = document.querySelector('.ml6');
ml7 = document.querySelector('.ml7');
ml13 = document.querySelector('.ml13');
ml8 = document.querySelector('.ml8');
ml9 = document.querySelector('.ml9');
ml10 = document.querySelector('.ml10');
ml101 = document.querySelector('.ml101');
ml31 = document.querySelector('.ml31');
ml30 = document.querySelector('.ml30');
ml17 = document.querySelector('.ml17');
ml171 = document.querySelector('.ml171');
ml181 = document.querySelector('.ml181');
ml19 = document.querySelector('.ml19');
ml20 = document.querySelector('.ml20');
ml21 = document.querySelector('.ml21');
mt1 = document.querySelector('.mt1');
mt2 = document.querySelector('.mt2');
mt3 = document.querySelector('.mt3');
mt4 = document.querySelector('.mt4');
mt5 = document.querySelector('.mt5');
ml22 = document.querySelector('.ml22');
mf1 = document.querySelector('.mf1');
mf2 = document.querySelector('.mf2');
mf3 = document.querySelector('.mf3');
t_screen = document.querySelector('.t-screen');
t_images = document.querySelector('.t-images');
ic_screen = document.querySelector('.ic-screen');
lo_screen = document.querySelector('.lo-screen');
ci_screen = document.querySelector('.ci-screen');
vg_screen = document.querySelector('.vg-screen');
lh_screen = document.querySelector('.lh-screen');

var i = 0;
var txt = 'Imaginary Conception'; /* The text */
var speed = 80; /* The speed/duration of the effect in milliseconds */

setTimeout(() => {
  window.onload = typeWriter();
}, 1000);

function playSentence1() {
  sentence_1.play();
}

function stopSentence1() {
  sentence_1.pause();
}

function playSentence2() {
  sentence_2.play();
}

function stopSentence2() {
  sentence_2.pause();
}

function playSentence3() {
  sentence_3.play();
}

function stopSentence3() {
  sentence_3.pause();
}

function playSentence4() {
  sentence_4.play();
}

function stopSentence4() {
  sentence_4.pause();
}

function playSentence5() {
  sentence_5.play();
}

function stopSentence5() {
  sentence_5.pause();
}

function playSentence6() {
  sentence_6.play();
}

function playSentence7() {
  sentence_7.play();
}

function stopSentence6() {
  sentence_6.pause();
}

function stopSentence7() {
  sentence_7.pause();
}

function typeWriter() {
  if (i < txt.length) {
    document.getElementById("animation").innerHTML += txt.charAt(i);
    i++;
    keyboard_audio.play();
    setTimeout(typeWriter, speed);
  }
}
setTimeout(() => {
  playSentence1();
}, 1000);

// Wrap every letter in a span
var textWrapper = document.querySelector('.ml11 .letters');
textWrapper.innerHTML = textWrapper.textContent.replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>");

anime.timeline({ loop: false })
  .add({
    targets: '.ml11 .line',
    scaleY: [0, 1],
    opacity: [0.5, 1],
    easing: "easeOutExpo",
    duration: 700
  })
  .add({
    targets: '.ml11 .line',
    translateX: [0, document.querySelector('.ml11 .letters').getBoundingClientRect().width + 10],
    easing: "easeOutExpo",
    duration: 1000,
    delay: 100
  }).add({
    targets: '.ml11 .letter',
    opacity: [0, 1],
    easing: "easeOutExpo",
    duration: 1000,
    offset: '-=775',
    delay: (el, i) => 34 * (i + 1)
  }).add({
    targets: '.ml11',
    opacity: 1,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 1000
  });

// Wrap every letter in a span
var textWrapper = document.querySelector('.ml12');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({ loop: false })
  .add({
    targets: '.ml12 .letter',
    opacity: [0, 1],
    easing: "easeInOutQuad",
    duration: 2250,
    delay: (el, i) => 50 * (i + 1)
  }).add({
    targets: '.ml12',
    opacity: 1,
    duration: 300,
    easing: "easeOutExpo",
    delay: 300
  });

// Wrap every letter in a span
var textWrapper = document.querySelector('.ml14');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({ loop: false })
  .add({
    targets: '.ml14 .letter',
    opacity: [0, 1],
    easing: "easeInOutQuad",
    duration: 2250,
    delay: (el, i) => 10 * (i + 1)
  }).add({
    targets: '.ml14',
    opacity: 1,
    duration: 300,
    easing: "easeOutExpo",
    delay: 300
  });

setTimeout(() => {
  arrow.classList.remove('d-none');
  setTimeout(() => {
    arrow.classList.remove('text-black');
  }, 5);
}, 3000);

function next() {
  setTimeout(() => {
    stopSentence1();
    setTimeout(() => {
      playSentence2();
    }, 3000);
  }, 1);
  // Wrap every letter in a span
  var textWrapper = document.querySelector('.ml11 .letters');
  textWrapper.innerHTML = textWrapper.textContent.replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>");

  arrow.classList.add('d-none');

  setTimeout(() => {
    arrow1.classList.remove('d-none');
    setTimeout(() => {
      arrow1.classList.remove('text-black');
    }, 5);
  }, 8000);

  anime.timeline({ loop: false })
    .add({
      targets: '.ml11 .line',
      scaleY: [0, 1],
      opacity: [1, 0.5],
      easing: "easeOutExpo",
      duration: 200
    })
    .add({
      targets: '.ml11 .line',
      translateX: [0, document.querySelector('.ml11 .letters').getBoundingClientRect().width + 10],
      easing: "easeOutExpo",
      duration: 200,
      delay: 100
    }).add({
      targets: '.ml11 .letter',
      opacity: [1, 0],
      easing: "easeOutExpo",
      duration: 400,
      offset: '-=775',
      delay: (el, i) => 34 * (i + 1)
    }).add({
      targets: '.ml11',
      opacity: 0,
      duration: 1000,
      easing: "easeOutExpo",
      delay: 500
    });

  // Wrap every letter in a span
  var textWrapper = document.querySelector('.ml12');
  textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

  anime.timeline({ loop: false })
    .add({
      targets: '.ml12 .letter',
      opacity: [1, 0],
      easing: "easeInOutQuad",
      duration: 150,
      delay: (el, i) => 30 * (i + 1)
    }).add({
      targets: '.ml12',
      opacity: 0,
      duration: 300,
      easing: "easeOutExpo",
      delay: 100
    });

  // Wrap every letter in a span
  var textWrapper = document.querySelector('.ml14');
  textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

  anime.timeline({ loop: false })
    .add({
      targets: '.ml14 .letter',
      opacity: [1, 0],
      easing: "easeInOutQuad",
      duration: 150,
      delay: (el, i) => 10 * (i + 1)
    }).add({
      targets: '.ml14',
      opacity: 1,
      duration: 100,
      easing: "easeOutExpo",
      delay: 100
    });

  setTimeout(() => {
    arrow.classList.add('text-black');
  }, 1500);
  setTimeout(() => {
    arrow.classList.add('d-none');
    ml11.classList.add('d-none');
    ml12.classList.add('d-none');
    ml14.classList.add('d-none');
  }, 2000);
  setTimeout(() => {
    ml15.classList.remove('d-none');
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml15 .letters');
    textWrapper.innerHTML = textWrapper.textContent.replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.ml15 .line',
        scaleY: [0, 1],
        opacity: [0.5, 1],
        easing: "easeOutExpo",
        duration: 700
      })
      .add({
        targets: '.ml15 .line',
        translateX: [0, document.querySelector('.ml15 .letters').getBoundingClientRect().width + 10],
        easing: "easeOutExpo",
        duration: 1000,
        delay: 100
      }).add({
        targets: '.ml15 .letter',
        opacity: [0, 1],
        easing: "easeOutExpo",
        duration: 1000,
        offset: '-=775',
        delay: (el, i) => 34 * (i + 1)
      }).add({
        targets: '.ml15',
        opacity: 1,
        duration: 1000,
        easing: "easeOutExpo",
        delay: 1000
      });
  }, 2800);
  setTimeout(() => {
    ml3.classList.remove('d-none');
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml3');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.ml3 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 2250,
        delay: (el, i) => 10 * (i + 1)
      }).add({
        targets: '.ml3',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
  }, 3000);

}

function next2() {
  setTimeout(() => {
    stopSentence2();
    setTimeout(() => {
      playSentence3();
    }, 3000);
  }, 1);
  // Wrap every letter in a span
  var textWrapper = document.querySelector('.ml15 .letters');
  textWrapper.innerHTML = textWrapper.textContent.replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>");

  arrow1.classList.add('d-none');

  setTimeout(() => {
    arrow2.classList.remove('d-none');
    setTimeout(() => {
      arrow2.classList.remove('text-black');
    }, 5);
  }, 11000);

  ml15.classList.remove('d-none');
  ml24.classList.add('d-flex');
  setTimeout(() => {
    ml24.classList.remove('d-none');
    setTimeout(() => {
      fadeIn(lo_screen);
    }, 1);
  }, 9000);

  anime.timeline({ loop: false })
    .add({
      targets: '.ml15 .line',
      scaleY: [0, 1],
      opacity: [1, 0.5],
      easing: "easeOutExpo",
      duration: 200
    })
    .add({
      targets: '.ml15 .line',
      translateX: [0, document.querySelector('.ml15 .letters').getBoundingClientRect().width + 10],
      easing: "easeOutExpo",
      duration: 200,
      delay: 100
    }).add({
      targets: '.ml15 .letter',
      opacity: [1, 0],
      easing: "easeOutExpo",
      duration: 400,
      offset: '-=775',
      delay: (el, i) => 34 * (i + 1)
    }).add({
      targets: '.ml15',
      opacity: 0,
      duration: 1000,
      easing: "easeOutExpo",
      delay: 500
    });
  // Wrap every letter in a span
  var textWrapper = document.querySelector('.ml3');
  textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

  anime.timeline({ loop: false })
    .add({
      targets: '.ml3 .letter',
      opacity: [1, 0],
      easing: "easeInOutQuad",
      duration: 150,
      delay: (el, i) => 5 * (i + 1)
    }).add({
      targets: '.ml3',
      opacity: 1,
      duration: 300,
      easing: "easeOutExpo",
      delay: 100
    });
  setTimeout(() => {
    ml15.classList.add('d-none');
    ml3.classList.add('d-none');
  }, 2600);
  setTimeout(() => {
    ml16.classList.remove('d-none');
    ml6.classList.remove('d-none');
  }, 3000);
  setTimeout(() => {
    ml16.classList.remove('d-none');
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml16 .letters');
    textWrapper.innerHTML = textWrapper.textContent.replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.ml16 .line',
        scaleY: [0, 1],
        opacity: [0.5, 1],
        easing: "easeOutExpo",
        duration: 700
      })
      .add({
        targets: '.ml16 .line',
        translateX: [0, document.querySelector('.ml16 .letters').getBoundingClientRect().width + 10],
        easing: "easeOutExpo",
        duration: 1000,
        delay: 100
      }).add({
        targets: '.ml16 .letter',
        opacity: [0, 1],
        easing: "easeOutExpo",
        duration: 1000,
        offset: '-=775',
        delay: (el, i) => 34 * (i + 1)
      }).add({
        targets: '.ml16',
        opacity: 1,
        duration: 1000,
        easing: "easeOutExpo",
        delay: 1000
      });
    ml6.classList.remove('d-none');
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml6');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.ml6 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 2250,
        delay: (el, i) => 50 * (i + 1)
      }).add({
        targets: '.ml6',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
    ml5.classList.remove('d-none');
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml5');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.ml5 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 2250,
        delay: (el, i) => 10 * (i + 1)
      }).add({
        targets: '.ml5',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
    setTimeout(() => {
      ml4.classList.remove('d-none');
      ml4.classList.add('d-flex');
      anime.timeline({ loop: false })
        .add({
          targets: '.ml4 .line',
          opacity: [0.5, 1],
          scaleX: [0, 1],
          easing: "easeInOutExpo",
          duration: 1200
        }).add({
          targets: '.ml4 .line',
          duration: 600,
          easing: "easeOutExpo",
          translateY: (el, i) => (-0.625 + 0.625 * 2 * i) + "em"
        }).add({
          targets: '.ml4 .ampersand',
          opacity: [0, 1],
          scaleY: [0.5, 1],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=600'
        }).add({
          targets: '.ml4 .letters-left',
          opacity: [0, 1],
          translateX: ["0.5em", 0],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=300'
        }).add({
          targets: '.ml4 .letters-right',
          opacity: [0, 1],
          translateX: ["-0.5em", 0],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=600'
        }).add({
          targets: '.ml4',
          opacity: 1,
          duration: 1000,
          easing: "easeOutExpo",
          delay: 1000
        });
    }, 5500);
  }, 3001);
}

function next3() {
  setTimeout(() => {
    stopSentence3();
    setTimeout(() => {
      playSentence4();
    }, 1000);
  }, 1);
  setTimeout(() => {
    setTimeout(() => {
      ml25.classList.add('d-flex');
    }, 1000);
    ml7.classList.remove('d-none');
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml7');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.ml7 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 250,
        delay: (el, i) => 25 * (i + 1)
      }).add({
        targets: '.ml7',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
    setTimeout(() => {
      ml25.classList.remove('d-none');
      fadeIn(ic_screen);
    }, 3000);
  }, 1000);
  arrow2.classList.add('d-none');
  fadeOut(lo_screen);
  setTimeout(() => {
    ml24.classList.add('d-none');
    ml5.classList.add('d-none');
    ml6.classList.add('d-none');
    ml4.classList.add('d-none');
  }, 700);
  setTimeout(() => {
    arrow3.classList.remove('d-none');
    setTimeout(() => {
      arrow3.classList.remove('text-black');
    }, 5);
  }, 6000);
  setTimeout(() => {
    ml25.classList.add('d-flex');
    ml9.classList.add('d-flex');
    setTimeout(() => {
      ml25.classList.remove('d-none');
      setTimeout(() => {
        fadeIn(ic_screen);
      }, 1);
    }, 3500);
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml7');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.ml7 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 250,
        delay: (el, i) => 50 * (i + 1)
      }).add({
        targets: '.ml7',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
    setTimeout(() => {
      ml9.classList.remove('d-none');
      anime.timeline({ loop: false })
        .add({
          targets: '.ml9 .line',
          opacity: [0.5, 1],
          scaleX: [0, 1],
          easing: "easeInOutExpo",
          duration: 1200
        }).add({
          targets: '.ml9 .line',
          duration: 600,
          easing: "easeOutExpo",
          translateY: (el, i) => (-0.625 + 0.625 * 2 * i) + "em"
        }).add({
          targets: '.ml9 .ampersand',
          opacity: [0, 1],
          scaleY: [0.5, 1],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=600'
        }).add({
          targets: '.ml9 .letters-left',
          opacity: [0, 1],
          translateX: ["0.5em", 0],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=300'
        }).add({
          targets: '.ml9 .letters-right',
          opacity: [0, 1],
          translateX: ["-0.5em", 0],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=600'
        }).add({
          targets: '.ml9',
          opacity: 1,
          duration: 1000,
          easing: "easeOutExpo",
          delay: 1000
        });
    }, 4000);
  }, 500);
  setTimeout(() => {
    ml5.classList.add('d-none');
    ml8.classList.remove('d-none');
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml8');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.ml8 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 2250,
        delay: (el, i) => 10 * (i + 1)
      }).add({
        targets: '.ml8',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
  }, 2000);
  // Wrap every letter in a span
  var textWrapper = document.querySelector('.ml6');
  textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

  anime.timeline({ loop: false })
    .add({
      targets: '.ml6 .letter',
      opacity: [1, 0],
      easing: "easeInOutQuad",
      duration: 250,
      delay: (el, i) => 5 * (i + 1)
    }).add({
      targets: '.ml6',
      opacity: 0,
      duration: 300,
      easing: "easeOutExpo",
      delay: 300
    });
  // Wrap every letter in a span
  var textWrapper = document.querySelector('.ml5');
  textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

  anime.timeline({ loop: false })
    .add({
      targets: '.ml5 .letter',
      opacity: [1, 0],
      easing: "easeInOutQuad",
      duration: 50,
      delay: (el, i) => 1 * (i + 1)
    }).add({
      targets: '.ml5',
      opacity: 0,
      duration: 300,
      easing: "easeOutExpo",
      delay: 300
    });
  anime.timeline({ loop: false })
    .add({
      targets: '.ml4 .line',
      opacity: [1, 0.5],
      scaleX: [0, 1],
      easing: "easeInOutExpo",
      duration: 200
    }).add({
      targets: '.ml4 .line',
      duration: 600,
      easing: "easeOutExpo",
      translateY: (el, i) => (-0.625 + 0.625 * 2 * i) + "em"
    }).add({
      targets: '.ml4 .letters-left',
      opacity: [1, 0],
      translateX: ["0.5em", 0],
      easing: "easeOutExpo",
      duration: 600,
      offset: '-=300'
    }).add({
      targets: '.ml4 .letters-right',
      opacity: [1, 0],
      translateX: ["-0.5em", 0],
      easing: "easeOutExpo",
      duration: 600,
      offset: '-=600'
    }).add({
      targets: '.ml4',
      opacity: 0,
      duration: 1000,
      easing: "easeOutExpo",
      delay: 1000
    });
}

function next4() {
  setTimeout(() => {
    stopSentence4();
    setTimeout(() => {
      playSentence5();
    }, 1000);
  }, 1);
  setTimeout(() => {
    setTimeout(() => {
      ml26.classList.add('d-flex');
    }, 1000);
    setTimeout(() => {
      ml10.classList.remove('d-none');
    }, 500);
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml10');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.ml10 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 250,
        delay: (el, i) => 10 * (i + 1)
      }).add({
        targets: '.ml10',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
  });
  fadeOut(ci_screen);
  setTimeout(() => {
    ml25.classList.add('d-none');
    ml7.classList.add('d-none');
    ml8.classList.add('d-none');
    ml9.classList.add('d-none');
  }, 500);
  arrow3.classList.add('d-none');
  setTimeout(() => {
    arrow4.classList.remove('d-none');
    setTimeout(() => {
      arrow4.classList.remove('text-black');
    }, 5);
  }, 6000);
  setTimeout(() => {
    ml26.classList.add('d-flex');
    setTimeout(() => {
      ml26.classList.remove('d-none');
      setTimeout(() => {
        fadeIn(vg_screen);
      }, 1);
    }, 3500);
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml10');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.ml10 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 250,
        delay: (el, i) => 50 * (i + 1)
      }).add({
        targets: '.ml10',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
    setTimeout(() => {

      ml13.classList.remove('d-none');
      anime.timeline({ loop: false })
        .add({
          targets: '.ml13 .line',
          opacity: [0.5, 1],
          scaleX: [0, 1],
          easing: "easeInOutExpo",
          duration: 1200
        }).add({
          targets: '.ml13 .line',
          duration: 600,
          easing: "easeOutExpo",
          translateY: (el, i) => (-0.625 + 0.625 * 2 * i) + "em"
        }).add({
          targets: '.ml13 .ampersand',
          opacity: [0, 1],
          scaleY: [0.5, 1],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=600'
        }).add({
          targets: '.ml13 .letters-left',
          opacity: [0, 1],
          translateX: ["0.5em", 0],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=300'
        }).add({
          targets: '.ml13 .letters-right',
          opacity: [0, 1],
          translateX: ["-0.5em", 0],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=600'
        }).add({
          targets: '.ml13',
          opacity: 1,
          duration: 1000,
          easing: "easeOutExpo",
          delay: 1000
        });
    }, 4000);
  }, 500);
  setTimeout(() => {
    ml8.classList.add('d-none');
    ml17.classList.remove('d-none');
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml17');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.ml17 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 2250,
        delay: (el, i) => 10 * (i + 1)
      }).add({
        targets: '.ml17',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
  }, 2000);
  // Wrap every letter in a span
  var textWrapper = document.querySelector('.ml7');
  textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

  anime.timeline({ loop: false })
    .add({
      targets: '.ml7 .letter',
      opacity: [1, 0],
      easing: "easeInOutQuad",
      duration: 250,
      delay: (el, i) => 5 * (i + 1)
    }).add({
      targets: '.ml7',
      opacity: 0,
      duration: 300,
      easing: "easeOutExpo",
      delay: 300
    });
  // Wrap every letter in a span
  var textWrapper = document.querySelector('.ml8');
  textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

  anime.timeline({ loop: false })
    .add({
      targets: '.ml8 .letter',
      opacity: [1, 0],
      easing: "easeInOutQuad",
      duration: 50,
      delay: (el, i) => 1 * (i + 1)
    }).add({
      targets: '.ml8',
      opacity: 0,
      duration: 300,
      easing: "easeOutExpo",
      delay: 300
    });
  anime.timeline({ loop: false })
    .add({
      targets: '.ml9 .line',
      opacity: [1, 0.5],
      scaleX: [0, 1],
      easing: "easeInOutExpo",
      duration: 200
    }).add({
      targets: '.ml9 .line',
      duration: 600,
      easing: "easeOutExpo",
      translateY: (el, i) => (-0.625 + 0.625 * 2 * i) + "em"
    }).add({
      targets: '.ml9 .letters-left',
      opacity: [1, 0],
      translateX: ["0.5em", 0],
      easing: "easeOutExpo",
      duration: 600,
      offset: '-=300'
    }).add({
      targets: '.ml9 .letters-right',
      opacity: [1, 0],
      translateX: ["-0.5em", 0],
      easing: "easeOutExpo",
      duration: 600,
      offset: '-=600'
    }).add({
      targets: '.ml9',
      opacity: 0,
      duration: 1000,
      easing: "easeOutExpo",
      delay: 1000
    });
  fadeOut(ic_screen);
  setTimeout(() => {
    ml25.classList.add('d-none');
  }, 700);
}

function next5() {
  setTimeout(() => {
    stopSentence5();
    setTimeout(() => {
      playSentence6();
    }, 1000);
  }, 1);
  setTimeout(() => {
    setTimeout(() => {
      mf3.classList.add('d-flex');
    }, 1000);
    setTimeout(() => {
      mf1.classList.remove('d-none');
    }, 500);
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.mf1');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.mf1 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 250,
        delay: (el, i) => 10 * (i + 1)
      }).add({
        targets: '.mf1',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
  });
  fadeOut(vg_screen);
  setTimeout(() => {
    ml26.classList.add('d-none');
    ml10.classList.add('d-none');
    ml17.classList.add('d-none');
  }, 500);
  arrow4.classList.add('d-none');
  setTimeout(() => {
    arrow5.classList.remove('d-none');
    setTimeout(() => {
      arrow5.classList.remove('text-black');
    }, 5);
  }, 6000);
  setTimeout(() => {
    mf2.classList.add('d-flex');
    mf3.classList.add('d-flex');
    setTimeout(() => {
      mf3.classList.remove('d-none');
    }, 3500);
    mf2.classList.add('d-flex');
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.mf1');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.mf1 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 250,
        delay: (el, i) => 50 * (i + 1)
      }).add({
        targets: '.mf1',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
    setTimeout(() => {

      ml13.classList.remove('d-none');
      anime.timeline({ loop: false })
        .add({
          targets: '.ml13 .line',
          opacity: [0.5, 1],
          scaleX: [0, 1],
          easing: "easeInOutExpo",
          duration: 1200
        }).add({
          targets: '.ml13 .line',
          duration: 600,
          easing: "easeOutExpo",
          translateY: (el, i) => (-0.625 + 0.625 * 2 * i) + "em"
        }).add({
          targets: '.ml13 .ampersand',
          opacity: [0, 1],
          scaleY: [0.5, 1],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=600'
        }).add({
          targets: '.ml13 .letters-left',
          opacity: [0, 1],
          translateX: ["0.5em", 0],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=300'
        }).add({
          targets: '.ml13 .letters-right',
          opacity: [0, 1],
          translateX: ["-0.5em", 0],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=600'
        }).add({
          targets: '.ml13',
          opacity: 1,
          duration: 1000,
          easing: "easeOutExpo",
          delay: 1000
        });
    }, 4000);
  }, 500);
  setTimeout(() => {
    ml17.classList.add('d-none');
    mf2.classList.remove('d-none');
    setTimeout(() => {
      mf2.classList.add('opacity1');
      mf2.classList.remove('opacity0');
    }, 1000);
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.mf100');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.mf100 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 2250,
        delay: (el, i) => 10 * (i + 1)
      }).add({
        targets: '.mf100',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
  }, 2000);
  // Wrap every letter in a span
  var textWrapper = document.querySelector('.ml10');
  textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

  anime.timeline({ loop: false })
    .add({
      targets: '.ml10 .letter',
      opacity: [1, 0],
      easing: "easeInOutQuad",
      duration: 250,
      delay: (el, i) => 5 * (i + 1)
    }).add({
      targets: '.ml10',
      opacity: 0,
      duration: 300,
      easing: "easeOutExpo",
      delay: 300
    });
  // Wrap every letter in a span
  var textWrapper = document.querySelector('.ml17');
  textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

  anime.timeline({ loop: false })
    .add({
      targets: '.ml17 .letter',
      opacity: [1, 0],
      easing: "easeInOutQuad",
      duration: 50,
      delay: (el, i) => 1 * (i + 1)
    }).add({
      targets: '.ml17',
      opacity: 0,
      duration: 300,
      easing: "easeOutExpo",
      delay: 300
    });
  fadeOut(vg_screen);
  setTimeout(() => {
    ml26.classList.add('d-none');
  }, 700);
}

function next6() {
  mf2.classList.add('d-none');
  setTimeout(() => {
    stopSentence6();
    setTimeout(() => {
      playSentence7();
    }, 1000);
  }, 1);
  setTimeout(() => {
    setTimeout(() => {
      ml261.classList.add('d-flex');
      setTimeout(() => {
        fadeIn(ci_screen);
      }, 2500);
    }, 1000);
    setTimeout(() => {
      ml101.classList.remove('d-none');
    }, 500);
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml101');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.ml101 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 250,
        delay: (el, i) => 10 * (i + 1)
      }).add({
        targets: '.ml101',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
  });
  fadeOut(lh_screen);
  setTimeout(() => {
    mf3.classList.add('d-none');
    mf1.classList.add('d-none');
    mf2.classList.add('d-none');
  }, 500);
  arrow5.classList.add('d-none');
  setTimeout(() => {
    arrow6.classList.remove('d-none');
    setTimeout(() => {
      arrow6.classList.remove('text-black');
    }, 5);
  }, 6000);
  setTimeout(() => {
    ml171.classList.add('d-flex');
    ml261.classList.add('d-flex');
    setTimeout(() => {
      ml261.classList.remove('d-none');
    }, 3500);
    ml171.classList.add('d-flex');
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml101');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.ml101 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 250,
        delay: (el, i) => 50 * (i + 1)
      }).add({
        targets: '.ml101',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
    setTimeout(() => {
      ml181.classList.remove('d-none');
      anime.timeline({ loop: false })
        .add({
          targets: '.ml181 .line',
          opacity: [0.5, 1],
          scaleX: [0, 1],
          easing: "easeInOutExpo",
          duration: 1200
        }).add({
          targets: '.ml181 .line',
          duration: 600,
          easing: "easeOutExpo",
          translateY: (el, i) => (-0.625 + 0.625 * 2 * i) + "em"
        }).add({
          targets: '.ml181 .ampersand',
          opacity: [0, 1],
          scaleY: [0.5, 1],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=600'
        }).add({
          targets: '.ml181 .letters-left',
          opacity: [0, 1],
          translateX: ["0.5em", 0],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=300'
        }).add({
          targets: '.ml181 .letters-right',
          opacity: [0, 1],
          translateX: ["-0.5em", 0],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=600'
        }).add({
          targets: '.ml181',
          opacity: 1,
          duration: 1000,
          easing: "easeOutExpo",
          delay: 1000
        });

      ml131.classList.remove('d-none');
      anime.timeline({ loop: false })
        .add({
          targets: '.ml131 .line',
          opacity: [0.5, 1],
          scaleX: [0, 1],
          easing: "easeInOutExpo",
          duration: 1200
        }).add({
          targets: '.ml131 .line',
          duration: 600,
          easing: "easeOutExpo",
          translateY: (el, i) => (-0.625 + 0.625 * 2 * i) + "em"
        }).add({
          targets: '.ml131 .ampersand',
          opacity: [0, 1],
          scaleY: [0.5, 1],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=600'
        }).add({
          targets: '.ml131 .letters-left',
          opacity: [0, 1],
          translateX: ["0.5em", 0],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=300'
        }).add({
          targets: '.ml131 .letters-right',
          opacity: [0, 1],
          translateX: ["-0.5em", 0],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=600'
        }).add({
          targets: '.ml131',
          opacity: 1,
          duration: 1000,
          easing: "easeOutExpo",
          delay: 1000
        });
    }, 4000);
  }, 500);
  setTimeout(() => {
    ml171.classList.remove('d-none');
    mf2.classList.add('d-none');
    setTimeout(() => {
      ml171.classList.add('opacity1');
      ml171.classList.remove('opacity0');
    }, 1000);
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.mf100');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.mf100 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 2250,
        delay: (el, i) => 10 * (i + 1)
      }).add({
        targets: '.mf100',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
  }, 2000);
  // Wrap every letter in a span
  var textWrapper = document.querySelector('.mf1');
  textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

  anime.timeline({ loop: false })
    .add({
      targets: '.mf1 .letter',
      opacity: [1, 0],
      easing: "easeInOutQuad",
      duration: 250,
      delay: (el, i) => 5 * (i + 1)
    }).add({
      targets: '.mf1',
      opacity: 0,
      duration: 300,
      easing: "easeOutExpo",
      delay: 300
    });
  // Wrap every letter in a span
  var textWrapper = document.querySelector('.mf2');
  textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");
    anime.timeline({ loop: false })
      .add({
        targets: '.mf2 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 500,
        delay: (el, i) => 10 * (i + 1)
      }).add({
        targets: '.mf2',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
  fadeOut(lh_screen);
}

function next7() {
  ml171.classList.add('d-none');
  setTimeout(() => {
    stopSentence7();
  }, 1);
  setTimeout(() => {
    ml20.classList.remove('d-none');
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml20');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.ml20 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 250,
        delay: (el, i) => 20 * (i + 1)
      }).add({
        targets: '.ml20',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
    setTimeout(() => {
      ml23.classList.remove('d-none');
      fadeIn(t_screen);
    }, 4000);
  }, 2000);
  arrow6.classList.add('d-none');
  ml16.classList.remove('d-none');
  anime.timeline({ loop: false })
    .add({
      targets: '.ml16 .line',
      scaleY: [0, 1],
      opacity: [1, 0.5],
      easing: "easeOutExpo",
      duration: 200
    })
    .add({
      targets: '.ml16 .line',
      translateX: [0, document.querySelector('.ml16 .letters').getBoundingClientRect().width + 10],
      easing: "easeOutExpo",
      duration: 200,
      delay: 100
    }).add({
      targets: '.ml16 .letter',
      opacity: [1, 0],
      easing: "easeOutExpo",
      duration: 400,
      offset: '-=775',
      delay: (el, i) => 34 * (i + 1)
    }).add({
      targets: '.ml16',
      opacity: 0,
      duration: 1000,
      easing: "easeOutExpo",
      delay: 500
    });
  setTimeout(() => {
    ml19.classList.remove('d-none');
    ml16.classList.add('d-none');
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml19 .letters');
    textWrapper.innerHTML = textWrapper.textContent.replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.ml19 .line',
        scaleY: [0, 1],
        opacity: [0.5, 1],
        easing: "easeOutExpo",
        duration: 700
      })
      .add({
        targets: '.ml19 .line',
        translateX: [0, document.querySelector('.ml19 .letters').getBoundingClientRect().width + 10],
        easing: "easeOutExpo",
        duration: 1000,
        delay: 100
      }).add({
        targets: '.ml19 .letter',
        opacity: [0, 1],
        easing: "easeOutExpo",
        duration: 1000,
        offset: '-=775',
        delay: (el, i) => 34 * (i + 1)
      }).add({
        targets: '.ml19',
        opacity: 1,
        duration: 1000,
        easing: "easeOutExpo",
        delay: 1000
      });
  }, 2200);
  setTimeout(() => {
    arrow7.classList.remove('d-none');
    arrow7.classList.add('d-flex');
    setTimeout(() => {
      arrow7.classList.remove('text-black');
    }, 5);
  }, 7000);
  setTimeout(() => {
    ml20.classList.remove('d-none');
  }, 2400);
  setTimeout(() => {
    ml101.classList.add('d-none');
    ml171.classList.add('d-none');
    ml181.classList.add('d-none');
    setTimeout(() => {
      ml22.classList.remove('d-none');
    }, 4000);
    ml13.classList.add('d-none');
    ml261.classList.add('d-flex');
    ml22.classList.add('d-flex');
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml20');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.ml20 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 250,
        delay: (el, i) => 50 * (i + 1)
      }).add({
        targets: '.ml20',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
    setTimeout(() => {
      ml22.classList.remove('d-none');
      ml261.classList.remove('d-none');
      anime.timeline({ loop: false })
        .add({
          targets: '.ml22 .line',
          opacity: [0.5, 1],
          scaleX: [0, 1],
          easing: "easeInOutExpo",
          duration: 1200
        }).add({
          targets: '.ml22 .line',
          duration: 600,
          easing: "easeOutExpo",
          translateY: (el, i) => (-0.625 + 0.625 * 2 * i) + "em"
        }).add({
          targets: '.ml22 .ampersand',
          opacity: [0, 1],
          scaleY: [0.5, 1],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=600'
        }).add({
          targets: '.ml22 .letters-left',
          opacity: [0, 1],
          translateX: ["0.5em", 0],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=300'
        }).add({
          targets: '.ml22 .letters-right',
          opacity: [0, 1],
          translateX: ["-0.5em", 0],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=600'
        }).add({
          targets: '.ml22',
          opacity: 1,
          duration: 1000,
          easing: "easeOutExpo",
          delay: 1000
        });
        anime.timeline({ loop: false })
        .add({
          targets: '.ml261 .line',
          opacity: [0.5, 1],
          scaleX: [0, 1],
          easing: "easeInOutExpo",
          duration: 1200
        }).add({
          targets: '.ml261 .line',
          duration: 600,
          easing: "easeOutExpo",
          translateY: (el, i) => (-0.625 + 0.625 * 2 * i) + "em"
        }).add({
          targets: '.ml261 .ampersand',
          opacity: [0, 1],
          scaleY: [0.5, 1],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=600'
        }).add({
          targets: '.ml261 .letters-left',
          opacity: [0, 1],
          translateX: ["0.5em", 0],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=300'
        }).add({
          targets: '.ml261 .letters-right',
          opacity: [0, 1],
          translateX: ["-0.5em", 0],
          easing: "easeOutExpo",
          duration: 600,
          offset: '-=600'
        }).add({
          targets: '.ml261',
          opacity: 1,
          duration: 1000,
          easing: "easeOutExpo",
          delay: 1000
        });
    }, 2000);
  }, 2000);
  fadeOut(ci_screen);
  setTimeout(() => {
    ml261.classList.add('d-none');
  }, 700);
  setTimeout(() => {
    ml171.classList.add('d-none');
    setTimeout(() => {
      ml21.classList.remove('d-none');
      setTimeout(() => {
        ml23.classList.remove('d-none');
      }, 3000);
    }, 1000);
    // Wrap every letter in a span
    var textWrapper = document.querySelector('.ml21');
    textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

    anime.timeline({ loop: false })
      .add({
        targets: '.ml21 .letter',
        opacity: [0, 1],
        easing: "easeInOutQuad",
        duration: 2250,
        delay: (el, i) => 10 * (i + 1)
      }).add({
        targets: '.ml21',
        opacity: 1,
        duration: 300,
        easing: "easeOutExpo",
        delay: 300
      });
  }, 2000);
  // Wrap every letter in a span
  var textWrapper = document.querySelector('.ml101');
  textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

  anime.timeline({ loop: false })
    .add({
      targets: '.ml101 .letter',
      opacity: [1, 0],
      easing: "easeInOutQuad",
      duration: 250,
      delay: (el, i) => 2 * (i + 1)
    }).add({
      targets: '.ml101',
      opacity: 0,
      duration: 300,
      easing: "easeOutExpo",
      delay: 300
    });
  // Wrap every letter in a span
  var textWrapper = document.querySelector('.ml171');
  textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

  anime.timeline({ loop: false })
    .add({
      targets: '.ml171 .letter',
      opacity: [1, 0],
      easing: "easeInOutQuad",
      duration: 50,
      delay: (el, i) => 1 * (i + 1)
    }).add({
      targets: '.ml171',
      opacity: 0,
      duration: 300,
      easing: "easeOutExpo",
      delay: 300
    });
  anime.timeline({ loop: false })
    .add({
      targets: '.ml181 .line',
      opacity: [1, 0.5],
      scaleX: [0, 1],
      easing: "easeInOutExpo",
      duration: 200
    }).add({
      targets: '.ml181 .line',
      duration: 600,
      easing: "easeOutExpo",
      translateY: (el, i) => (-0.625 + 0.625 * 2 * i) + "em"
    }).add({
      targets: '.ml181 .letters-left',
      opacity: [1, 0],
      translateX: ["0.5em", 0],
      easing: "easeOutExpo",
      duration: 600,
      offset: '-=300'
    }).add({
      targets: '.ml181 .letters-right',
      opacity: [1, 0],
      translateX: ["-0.5em", 0],
      easing: "easeOutExpo",
      duration: 600,
      offset: '-=600'
    }).add({
      targets: '.ml181',
      opacity: 0,
      duration: 1000,
      easing: "easeOutExpo",
      delay: 1000
    });

  anime.timeline({ loop: false })
    .add({
      targets: '.ml13 .line',
      opacity: [1, 0.5],
      scaleX: [0, 1],
      easing: "easeInOutExpo",
      duration: 200
    }).add({
      targets: '.ml13 .line',
      duration: 600,
      easing: "easeOutExpo",
      translateY: (el, i) => (-0.625 + 0.625 * 2 * i) + "em"
    }).add({
      targets: '.ml13 .letters-left',
      opacity: [1, 0],
      translateX: ["0.5em", 0],
      easing: "easeOutExpo",
      duration: 600,
      offset: '-=300'
    }).add({
      targets: '.ml13 .letters-right',
      opacity: [1, 0],
      translateX: ["-0.5em", 0],
      easing: "easeOutExpo",
      duration: 600,
      offset: '-=600'
    }).add({
      targets: '.ml13',
      opacity: 0,
      duration: 1000,
      easing: "easeOutExpo",
      delay: 1000
    });
}

function fadeIn(t_screen) {
  t_screen.style.opacity = 0;
  var tick = function () {
    t_screen.style.opacity = +t_screen.style.opacity + 0.01;
    if (+t_screen.style.opacity < 1) {
      (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16)
    }
  };
  tick();
}

function fadeIn(t_images) {
  t_images.style.opacity = 0;
  var tick = function () {
    t_images.style.opacity = +t_images.style.opacity + 0.01;
    if (+t_images.style.opacity < 1) {
      (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16)
    }
  };
  tick();
}


function fadeIn(ic_screen) {
  ic_screen.style.opacity = 0;
  var tick = function () {
    ic_screen.style.opacity = +ic_screen.style.opacity + 0.01;
    if (+ic_screen.style.opacity < 1) {
      (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16)
    }
  };
  tick();
}

function fadeIn(lh_screen) {
  lh_screen.style.opacity = 0;
  var tick = function () {
    lh_screen.style.opacity = +lh_screen.style.opacity + 0.01;
    if (+lh_screen.style.opacity < 1) {
      (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16)
    }
  };
  tick();
}

function fadeIn(lo_screen) {
  lo_screen.style.opacity = 0;
  var tick = function () {
    lo_screen.style.opacity = +lo_screen.style.opacity + 0.01;
    if (+lo_screen.style.opacity < 1) {
      (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16)
    }
  };
  tick();
}

function fadeIn(ci_screen) {
  ci_screen.style.opacity = 0;
  var tick = function () {
    ci_screen.style.opacity = +ci_screen.style.opacity + 0.01;
    if (+ci_screen.style.opacity < 1) {
      (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16)
    }
  };
  tick();
}

function fadeIn(vg_screen) {
  vg_screen.style.opacity = 0;
  var tick = function () {
    vg_screen.style.opacity = +vg_screen.style.opacity + 0.01;
    if (+vg_screen.style.opacity < 1) {
      (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 16)
    }
  };
  tick();
}

function fadeOut(ic_screen) {
  var op = 1;  // initial opacity
  var timer = setInterval(function () {
    if (op <= 0.1) {
      clearInterval(timer);
    }
    ic_screen.style.opacity = op;
    op -= 0.1;
  }, 50);
}

function fadeOut(lh_screen) {
  var op = 1;  // initial opacity
  var timer = setInterval(function () {
    if (op <= 0.1) {
      clearInterval(timer);
    }
    lh_screen.style.opacity = op;
    op -= 0.1;
  }, 50);
}

function fadeOut(lo_screen) {
  var op = 1;  // initial opacity
  var timer = setInterval(function () {
    if (op <= 0.1) {
      clearInterval(timer);
    }
    lo_screen.style.opacity = op;
    op -= 0.1;
  }, 50);
}

function fadeOut(ci_screen) {
  var op = 1;  // initial opacity
  var timer = setInterval(function () {
    if (op <= 0.1) {
      clearInterval(timer);
    }
    ci_screen.style.opacity = op;
    op -= 0.1;
  }, 50);
}

function fadeOut(vg_screen) {
  var op = 1;  // initial opacity
  var timer = setInterval(function () {
    if (op <= 0.1) {
      clearInterval(timer);
    }
    vg_screen.style.opacity = op;
    op -= 0.1;
  }, 50);
}

function fadeOut(t_screen) {
  var op = 1;  // initial opacity
  var timer = setInterval(function () {
    if (op <= 0.1) {
      clearInterval(timer);
    }
    t_screen.style.opacity = op;
    op -= 0.1;
  }, 50);
}

function fadeOut(t_images) {
  var op = 1;  // initial opacity
  var timer = setInterval(function () {
    if (op <= 0.1) {
      clearInterval(timer);
    }
    t_images.style.opacity = op;
    op -= 0.1;
  }, 50);
}

function overlay() {

  let overlay = document.querySelector('.overlay');
  let seemore = document.querySelector('#seemore');

  if (overlay.classList.contains('d-none')) {
    overlay.classList.remove('d-none');
    overlay.classList.add('d-flex');
    seemore.classList.add('text-danger');
    arrow6.classList.add('text-danger');
  } else {
    overlay.classList.add('d-none');
    overlay.classList.remove('d-flex');
    seemore.classList.remove('text-danger');
    arrow6.classList.remove('text-danger');
  }

}