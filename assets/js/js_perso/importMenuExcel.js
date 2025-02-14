document.getElementById('previewButton').addEventListener('click', function() {
    var fileInput = document.getElementById('formFile');
    var file = fileInput.files[0];

    if (!file) {
      alert("Veuillez sélectionner un fichier Excel.");
      return;
    }

    var reader = new FileReader();
    reader.onload = function(e) {
      var data = new Uint8Array(e.target.result);
      var workbook = XLSX.read(data, {
        type: 'array'
      });

      // Supposons que les données sont dans la première feuille
      var firstSheet = workbook.Sheets[workbook.SheetNames[0]];
      var rows = XLSX.utils.sheet_to_json(firstSheet, {
        header: 1
      });

      // Générer un tableau HTML pour afficher l'aperçu des menus
      var tableHtml = '<table class="table"><thead><tr><th>Date</th><th>Entrée</th><th>Plat</th><th>Dessert</th></tr></thead><tbody>';

      rows.forEach(function(row, index) {

        var excelDate = row[0]; // Date en format Excel
        var readableDate = excelDateToJSDate(excelDate); // Convertir en date lisible

        tableHtml += '<tr>';
        tableHtml += '<td>' + readableDate + '</td>'; // Date convertie
        tableHtml += '<td>' + (row[1] || '') + '</td>'; // Entrée
        tableHtml += '<td>' + (row[2] || '') + '</td>'; // Plat
        tableHtml += '<td>' + (row[3] || '') + '</td>'; // Dessert
        tableHtml += '</tr>';
      });
      tableHtml += '</tbody></table>';

      document.getElementById('previewTable').innerHTML = tableHtml;

      // Stocker les données JSON (incluant l'en-tête)
      window.excelData = rows;
    };

    reader.readAsArrayBuffer(file);
  });

  function excelDateToJSDate(excelDate) {
    // Vérifier si excelDate est un nombre
    if (!isNaN(excelDate)) {
      // Convertir le nombre Excel en une date JavaScript (en millisecondes)
      var date = new Date((excelDate - 25569) * 86400 * 1000);

      // Formatage de la date selon les paramètres régionaux (ex: 17/07/2024)
      return date.toLocaleDateString();
    } else {
      // Si ce n'est pas un nombre, retourner la valeur telle qu'elle est (probablement une chaîne déjà au bon format)
      return excelDate;
    }
  }
  // Soumission des données au serveur via fetch
  document.getElementById('submitButton').addEventListener('click', function(e) {
    e.preventDefault();

    if (!window.excelData || window.excelData.length === 0) {
      alert("Veuillez d'abord prévisualiser un fichier avant de le soumettre.");
      return;
    }


    fetch('/admin/import-menu', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(window.excelData),
      })
      .then(response => response.json()) // Lire la réponse JSON
      .then(result => {
        // Si la réponse contient une URL de redirection, rediriger l'utilisateur
        if (result.redirect) {
          window.location.href = result.redirect; // Redirection côté client
        }
      })
      .catch(error => {
        console.error('Erreur lors de l\'envoi des données :', error);
      });

    /** code pour débuger 
    // Envoi des données Excel (incluant l'en-tête) au serveur
    fetch('/admin/import-menu', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(window.excelData),
      })
      .then(response => response.text()) // Lire la réponse comme texte brut
      .then(text => {
        console.log("Réponse brute du serveur :", text); // Affiche la réponse brute pour déboguer
        try {
          const result = JSON.parse(text); // Tenter de décoder la réponse en JSON
          console.log(result);
          alert(result.message);
        } catch (error) {
          console.error('Erreur lors de la conversion en JSON :', error);
          alert("La réponse reçue n'est pas du JSON valide.");
        }
      })
      .catch(error => {
        console.error('Erreur lors de l\'envoi des données :', error);
        alert("Une erreur est survenue lors de l'envoi des données.");
      });
*/
  });