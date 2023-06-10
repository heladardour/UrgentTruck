$(document).ready(function() {
    // Lorsque le gouvernorat est sélectionné, charger les hôpitaux correspondants via une requête AJAX
    $('#gouvernorat').change(function() {
      var gouvernorat = $(this).val();
  
      $.ajax({
        url: 'get_hopitaux.php',
        method: 'POST',
        data: { gouvernorat: gouvernorat },
        success: function(data) {
          $('#hopital').html(data);
        }
      });
    });
  
    // Obtenir et afficher la date actuelle
    var date = new Date();
    var dateString = date.toLocaleDateString('fr-FR');
    $('#date').text('Date: ' + dateString);
  
    // Obtenir et afficher l'heure actuelle
    var heureString = date.toLocaleTimeString('fr-FR');
    $('#heure').text('Heure: ' + heureString);
  });
  