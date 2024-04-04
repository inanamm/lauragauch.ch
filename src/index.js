import Alpine from 'alpinejs';
import Swup from 'swup';
import Glide from "@glidejs/glide";
import { animate } from "motion"

// import style for js
import './index.css'

// Alpine
window.Alpine = Alpine;
Alpine.start();

// SWUP
const swup = new Swup();

if (document.querySelector(".glide")) {
    let glide = new Glide(".glide", {
      type: "carousel",
      startAt: 0,
      perView: 1,
      gap: 5,
      peek: {
        before: 15,
        after: window.innerWidth / 5,
      },
    });
  
    glide.mount();
  
    window.addEventListener("resize", function () {
      glide.update({
        peek: {
          before: 15,
          after: window.innerWidth / 5,
        },
      });
    });
  }
  