<?= $this->extend('layout') ?>

<?= $this->section('head') ?>
    <script src="<?= base_url('leaflet/leaflet.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('leaflet/leaflet.css') ?>" />
    <style>
        #maps {
            height: 500px;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h1>Peta Indonesia</h1>
<p id="nama_kota"></p>
<div id="maps"></div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    var map = L.map('maps').setView({ lat : -0.085497, lon : 109.317730 }, 7);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
    }).addTo(map);

    L.marker({lat : 0.7893, lon : 113.9213}).bindPopup('Pontianak').addTo(map);
    // var geojson = L.geoJson(data).addTo(map);
    async function polygon() {
        // C:\xampp\htdocs\SIGSKRIPSI\public\maps\pontianak.geojson
        const response = await fetch("<?php echo base_url("/"); ?>/maps/pontianak.geojson");
        const data = await response.json();
        console.log(data.name);
        document.getElementById("nama_kota").innerHTML = data.name;
    }

    polygon();

</script>
<?= $this->endSection() ?>