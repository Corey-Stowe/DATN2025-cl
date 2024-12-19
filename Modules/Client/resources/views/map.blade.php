<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaflet Delivery Tracking</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    </script>
</head>

<body>
    <div id="map" style="height: 500px; width: 100%;"></div>
    <input type="text" id="location" placeholder="Nhập địa chỉ..." style="width: 100%; padding: 10px; margin-top: 10px;">
    <ul id="results" style="list-style: none; padding: 0; margin: 10px 0;"></ul>

    <script>
        // Tạo bản đồ Leaflet
        const map = L.map('map').setView([10.8231, 106.6297], 13);

        // Thêm tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // Tạo marker ban đầu
        const deliveryMarker = L.marker([10.8231, 106.6297]).addTo(map).bindPopup("Địa điểm ban đầu").openPopup();

                // Xử lý tìm kiếm với Nominatim
            $('#location').on('input', function () {
            const query = $(this).val();
            if (query.length > 2) {
                // Gửi yêu cầu tới Nominatim API
                $.getJSON(`https://nominatim.openstreetmap.org/search?format=json&q=${query}`, function (data) {
                $('#results').empty();
                data.forEach(place => {
                    $('#results').append(`<li data-lat="${place.lat}" data-lon="${place.lon}" style="cursor: pointer; padding: 5px; border: 1px solid #ccc;">${place.display_name}</li>`);
                });
                });
            }
            });

            // Khi người dùng chọn địa chỉ từ danh sách
            $('#results').on('click', 'li', function () {
            const lat = $(this).data('lat');
            const lon = $(this).data('lon');

            // Cập nhật marker và bản đồ
            deliveryMarker.setLatLng([lat, lon]).bindPopup(`Vị trí: ${lat}, ${lon}`).openPopup();
            map.setView([lat, lon], 15);
            // Xóa danh sách kết quả
            $('#results').empty();
            $('#location').val($(this).text());
            });

        // Khởi tạo Autocomplete khi DOM đã sẵn sàng
        $(document).ready(function() {
            initialize();
        });

        // Tuyến đường mẫu
        const routeCoordinates = [
            [10.8231, 106.6297],
            [10.8201, 106.6801],
            [10.8301, 106.7001],
            [ 20.9821715, 105.7842539]
        ];
        const route = L.polyline(routeCoordinates, {
            color: 'blue',
            weight: 5,
            opacity: 0.7
        }).addTo(map);
        map.fitBounds(route.getBounds());

        // Update marker location
        function updateDeliveryLocation() {
            fetch('/v1/getshipping/12345')
                .then((response) => response.json())
                .then((data) => {
                    const { latitude, longitude } = data;
                    deliveryMarker.setLatLng([latitude, longitude])
                        .bindPopup(`Vị trí hiện tại: ${latitude}, ${longitude}`)
                        .openPopup();
                    map.panTo([latitude, longitude]);
                });
        }

        setInterval(updateDeliveryLocation, 5000);
    </script>
</body>

</html>
