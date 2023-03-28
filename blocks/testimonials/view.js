(function() {
  
    const sliderWrapper = document.querySelector('.testimonials')
    const sliderViewport = document.querySelector('.testimonials__viewport')
    const slider = document.querySelector('.testimonials__slider')
    const slides = slider.querySelectorAll('.quote')
    const slidesInView = 2;
  
    const observerSettings = {
      root: sliderViewport,
      rootMargin: '-20px'
    }
  
    if ('IntersectionObserver' in window) {
      const callback = (slides, observer) => {
        Array.prototype.forEach.call(slides, function(entry) {
          entry.target.classList.remove('visible')
          if (!entry.intersectionRatio > 0) {
            return
          }
          entry.target.classList.add('visible')
        })
      }
  
      const observer = new IntersectionObserver(callback, observerSettings)
      Array.prototype.forEach.call(slides, t => observer.observe(t))
  
      const controls = document.createElement('div')
      controls.classList.add('testimonials__controls')
      controls.setAttribute('aria-label', 'testimonial slider controls')
      controls.innerHTML = `
        <button id="previous" aria-label="previous">
          <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm0 1c6.071 0 11 4.929 11 11s-4.929 11-11 11-11-4.929-11-11 4.929-11 11-11zm3 5.753l-6.44 5.247 6.44 5.263-.678.737-7.322-6 7.335-6 .665.753z"/></svg>
        </button>
        <button id="next" aria-label="next">
          <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm0 1c6.071 0 11 4.929 11 11s-4.929 11-11 11-11-4.929-11-11 4.929-11 11-11zm-3 5.753l6.44 5.247-6.44 5.263.678.737 7.322-6-7.335-6-.665.753z"/></svg>
        </button> 
      `
  
      sliderWrapper.append(controls)
  
      function scrollIt (slideToShow) {
        let slideWidth = sliderViewport.scrollWidth / slides.length;
        let slideNum = Array.prototype.indexOf.call(slides, slideToShow);
        let scrollPos = slideNum * slideWidth;
        sliderViewport.scrollLeft = scrollPos;
      }
  
      function showSlide (dir, slides) {
        let visible = document.querySelectorAll('.testimonials__slider .visible')
        let i = dir === 'previous' ? 0 : 1
        //if more than 1 is visible scroll to first of visible (prev) or second (next)
        if (visible.length > slidesInView) {
          scrollIt(visible[i])
        } else {
        // prev, get element before first visible
        // next, get element after first visible
          let newSlide = i === 0 ? visible[0].previousElementSibling : visible[0].nextElementSibling
          if (newSlide) {
            scrollIt(newSlide)
          }
        }
      }
  
      controls.addEventListener('click', function (e) {
        showSlide(e.target.closest('button').id, slides)
      })
    }
  })()