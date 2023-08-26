$(document).ready(function() {
    $('.js-info-table').hide();

    $('#coord-form').submit(function(event) {
        event.preventDefault();
        $('.js-city-data').remove();
        $('.error').hide();
        $('.js-info-table').hide();

        let formData = $(this).serializeArray();
        const numberReg = /^(\d+(\.\d*)?|\.\d+)$/;
        const latitude = formData.find(field => field.name === 'latitude').value;
        const longitude = formData.find(field => field.name === 'longitude').value;

        if (!numberReg.test(latitude) || !numberReg.test(longitude) ) {
            $('.error').show();
            $('.error').text('Input not valid. Input should be numeric and can contain dot. Example: 43.5429256');
        }

        $.ajax({
            type: 'POST',
            url:  '/src/ajax/forms/coordinate.process.php',
            data: formData,
            success: function(response) {
                console.log(response)
                response = JSON.parse(response)
                let rows = ''
                response.forEach(function (city) {
                    rows += `<tr class="js-city-data">
                        <td>${city.name}</td>
                        <td>${city.minTemp}</td>
                        <td>${city.maxTemp}</td>
                        <td>${city.curDistance}</td>
                        <td>${city.weatherDescription}</td>
                        <td><img src="${city.icon}" alt="Weather icon"></td>
                    </tr>`;
                });
                $('.js-info-table').append(rows);
                $('.js-info-table').show();
            }
        });
    });
});
