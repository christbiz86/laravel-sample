    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
        var url = 'http://www.json-generator.com/api/json/get/cbEfqLwFaq?indent=2';
        var table = $('#table').DataTable({
          'processing': true,
          'serverSide': true,
          'ajax': {
            type: 'POST',
            'url': url,
            'data': function(d) {
              console.log(d.order);
              return JSON.stringify(d);
            }
          },
          "initComplete": function(settings, json) {
            data = table.rows().data()
            var categories = []; 
            var series_data = [];
            for (var i = 0; i < data.length; i++) {
              categories.push(data[i][0])
              series_data.push(Number([data[i][5].match(/\d/g).join("")]))
            }

            plotChart(categories, series_data)
          }
        });

        $('#reload').click(function(e) {
          table.ajax.reload();
        });
      });

      function plotChart(categories, series_data) {
        Highcharts.chart('container', {
          chart: {
            type: 'column'
          },
          xAxis: {
            categories: categories
          },
          yAxis: {
            title: {
              text: 'Count'
            }
          },
          series: [{
            name: 'person',
            data: series_data
          }]
        });
      }
    </script>