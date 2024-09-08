document.addEventListener('DOMContentLoaded', function() {
    fetch('resultados.php')  // Cambia 'resultados.php' a la ruta de tu script PHP
      .then(response => response.json())
      .then(data => {
        const tablaDibujos = document.getElementById('tabla-dibujos').getElementsByTagName('tbody')[0];
        const tablaVotantes = document.getElementById('tabla-votantes').getElementsByTagName('tbody')[0];
        
        // Llenar la tabla de los 3 dibujos más votados
        data.dibujos.forEach(dibujo => {
          const fila = tablaDibujos.insertRow();
          fila.insertCell().textContent = dibujo.grado;
          fila.insertCell().innerHTML = `<img src="images/${dibujo.grado}/${dibujo.dibujo}" alt="${dibujo.dibujo}" style="max-width: 100px;">`;
          fila.insertCell().textContent = dibujo.votos;
        });
        
        // Llenar la tabla de los últimos 5 votantes
        data.votantes.forEach(votante => {
          const fila = tablaVotantes.insertRow();
          fila.insertCell().textContent = votante.nombre;
          fila.insertCell().textContent = votante.grado;
          fila.insertCell().innerHTML = `<img src="images/${votante.grado}/${votante.dibujo}" alt="${votante.dibujo}" style="max-width: 100px;">`;
        });
      })
      .catch(error => console.error('Error cargando los resultados:', error));
  });
  