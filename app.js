// JS that handles creating new TPs and AJAX request
$(function() {
  // Defining variables
  var $form = $('#my-form');
  var $levForm = $('#lev-form');
  var $fields = $form.find('.fields');
  var tpCount = 0;

  // Function to add TPs when user wants to
  $form.on('click', '.add-fields', function() {
      // Setting the unique tpCount per tp
      tpCount += 1;

      // Creating the div for the TPs
      var div = document.createElement("div");
      div.classList = "tp-fields tp-fields-" + tpCount;
      div.id = "tp-fields-" + tpCount;
      // Creating the label for tp
      var tpLabel = document.createElement("label");
      tpLabel.classList = "input input-bordered gap-2 m-2";
      tpLabel.id = "tp-label-" + tpCount;
      // Creating the tp input
      var tpInput = document.createElement("input");
      tpInput.classList = "grow m-2";
      tpInput.id = "tp-input-" + tpCount;
      tpInput.name = "tp-input-" + tpCount;
      tpInput.type = "number";
      tpInput.placeholder = "63369";
      tpInput.step = ".01";
      tpInput.required = true;
      // Creating the tpp input
      var tppInput = document.createElement("input");
      tppInput.classList = "grow m-2";
      tppInput.id = "tpp-input-" + tpCount;
      tppInput.name = "tpp-input-" + tpCount;
      tppInput.type = "number";
      tppInput.placeholder = "30";
      tppInput.step = ".01";
      tppInput.required = true;
      // Creating the tp delete button
      var tpBtn = document.createElement("button");
      tpBtn.classList = "remove-fields m-2";
      tpBtn.type = "button";
      tpBtn.id = "tpBtn-" + tpCount;
      tpBtn.textContent = "TP verwijderen";
      // Creating $ and % ps
      var ds = document.createElement("span");
      var ps = document.createElement("span");
      ps.classList = "ms-5";
      ds.innerText = "TP $"
      ps.innerText = "TP %"
      // Adding all of these together
      tpLabel.appendChild(ds);
      tpLabel.appendChild(tpInput);
      tpLabel.appendChild(ps);
      tpLabel.appendChild(tppInput);
      div.appendChild(tpLabel);
      div.appendChild(tpBtn);
      $fields.prepend($(div));
  });

  // Function to remove TPs when user wants to
  $form.on('click', '.remove-fields', function(event) {
      $(event.target).closest('.tp-fields').remove();
  });

  // Form submit and AJAX request
  $form.on('submit', function(e) {
      e.preventDefault();

      // Getting the error en resdata div
      let $error = $('#error');
      let $resdata = $('#resdata');

      // Handling the AJAX request
      $.ajax({
          type: 'GET',
          url: 'calculate.php',
          data: $(this).serialize()
      }).then(function(res) {
          console.log(res);
          let data = JSON.parse(res);
          if (data.error) {
              $error.removeClass('d-none').html(data.error);
              return;
          } else if (data.resdata) {
              $resdata.removeClass('d-none').html(
                  "Winst percentage ZONDER LEVERAGE: " + data.wp + "%" + "<br>" +
                  "Totale eind RR: " + data.rr
              );
              return;
          }
      }).fail(function(res) {
          $error.removeClass('d-none').html(data.error);
      });
  });

  // LevForm submit and AJAX request
  $levForm.on('submit', function(e) {
      e.preventDefault();

      // Getting the error en resdata div
      let $error = $('#error');
      let $levdata = $('#levdata');

      // Handling the AJAX request
      $.ajax({
          type: 'GET',
          url: 'calculate.php',
          data: $(this).serialize()
      }).then(function(res) {
          console.log(res);
          let data = JSON.parse(res);
          if (data.error) {
              $error.removeClass('d-none').html(data.error);
              return;
          } else if (data.levdata) {
              $levdata.removeClass('d-none').html(
                  "Leverage: " + data.lev
              );
              return;
          }
      }).fail(function(res) {
          $error.removeClass('d-none').html(data.error);
      });
  });
});