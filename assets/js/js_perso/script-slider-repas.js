const repasSlider = document.querySelector('#rangSlider');
    repasSlider.insertAdjacentHTML('afterend', `
    <output>${repasSlider.value} repas</output>
  `);

    document.getElementById("rangSlider").addEventListener('input', e => {
      const input = e.target;
      const output = input.nextElementSibling;
      if (output) {
        output.textContent = input.value + " repas";
      }
    });