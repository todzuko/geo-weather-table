<!DOCTYPE html>
<html>
<head>
    <title>My Simple HTML Page</title>
</head>
<body>
<form id="coord-form">
    <label>Latitude
        <input type="text" name="longitude" />
    </label>
    <label>Longitude
        <input type="text" name="latitude" />
    </label>
    <button type="submit">Submit</button>
</form>
<div class="error" style="color:red"></div>
<br/>
<table class="js-info-table">
<tr>
    <th>City name</th>
    <th>Min temperature</th>
    <th>Max temperature</th>
    <th>Distance to entered coordinates</th>
    <th>Weather description</th>
    <th>Weather icon</th>
</tr>

</table>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="/public/js/script.js"></script>
</body>
</html>
