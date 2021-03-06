<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	// dd($kode_kendaraan);	
	
	$this->load->view('customer/header');
?>
<div class="progress rounded-0 sticky-top" style="height: 8px; top: 64px;">
    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
<section class="section-padding width mx-auto mt-64 min-vh-md-100">
	<div class="container">
		<form action="<?= base_url('customer/keranjang/checkout_2') ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi'] ?>">
			<input type="hidden" name="kode_kendaraan" value="<?= @$kode_kendaraan ?>">
			<input type="hidden" name="subtotal" value="<?= @$subtotal ?>">
			<div class="row">
				<div class="col-lg-7">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-no-gutter">
							<li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
							<li class="breadcrumb-item"><a href="<?= base_url('produk') ?>">transaksi</a></li>
							<li class="breadcrumb-item active" aria-current="page"><?= 'no pemesanan' ?></li>
						</ol>
					</nav>
					<h1 class="h2 mb-5"> <span class="font-weight-bold">Detail Pemesanan</span><span class="text-muted float-right">Step 1</span> </h1>
						<?php echo $this->session->flashdata('msg');?>

						<div class="text-block">
							<div class="row mb-3">
								<div class="col-md-6 d-flex align-items-center mb-3 mb-md-0">
									<div class="form-group">
										<label class="input-label" for="tgl_Pesan">Tanggal Sewa</label>
										<input type="date" class="form-control" name="tgl_sewa" id="tgl_Pesan" placeholder="Tanggal Pemesanan" required="" value="<?= @$transaksi['tgl_sewa'] ?>">
									</div>
								</div>
								<div class="col-md-6 d-flex align-items-center">
									<div class="form-group">
										<label class="input-label" for="tgl_Kembali">Tanggal Pengembalian</label>
										<input type="date" class="form-control" name="tgl_pengembalian" id="tgl_Kembali" placeholder="Tanggal Pengembalian" required="" value="<?= @$transaksi['tgl_pengembalian'] ?>">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="input-label" for="tujuanLabel">Tujuan sewa?</label>
								<select class="form-control" name="id_tujuan" id="tujuanLabel" required>
									<?php foreach ($list_tujuan as $key => $tujuan) : ?>
										<option value="<?= $tujuan->id ?>" <?= @$transaksi['id_tujuan'] == $tujuan->id ? 'selected' : '' ?>><?= strtoupper($tujuan->tujuan) ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="text-block">
							<h5 class="mb-3">Pengiriman</h5>
							<div class="row mb-5">
								<div class="col">
									<!-- <div class="custom-control custom-radio custom-control-inline">
										<input type="radio" id="labelPenghantaran1" name="metode_pengambilan"
											class="custom-control-input" value="1" checked>
										<label class="custom-control-label font-weight-500" for="labelPenghantaran1">Hantar</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
										<input type="radio" id="labelPenghantaran2" name="metode_pengambilan"
											class="custom-control-input" value="2">
										<label class="custom-control-label font-weight-500" for="labelPenghantaran2">Ambil di Toko kami</label>
									</div> -->
									<label class="input-label">Metode Pengambilan</label>
									<div class="pill-toggle">
										<input id="labelPengantaran1" name="metode_pengambilan" data-id="toggle-type-1" type="radio" value="Dikirim" <?= @$transaksi['metode_pengambilan'] === 'Dikirim' || empty($transaksi['metode_pengambilan']) ? 'checked' : '' ?>>
										<label class="pill-toggle-item" for="labelPengantaran1"> Kirim ke Lokasi </label>
										<input id="labelPengantaran2" name="metode_pengambilan" data-id="toggle-type-2"  type="radio" value="Diambil" <?= @$transaksi['metode_pengambilan'] === 'Diambil' ? 'checked' : '' ?>>
										<label class="pill-toggle-item"for="labelPengantaran2"> Ambil di Toko kami </label>
									</div>
								</div>
							</div>
							<div class="pemesananTipe1">
								<div class="form-group">
									<label class="input-label" for="alamat">Alamat pengiriman</label>
									<textarea type="text" class="form-control" name="alamat_pengiriman" id="alamat_pengiriman" rows="3" placeholder="Alamat pengiriman" required=""><?= @$transaksi['alamat_pengiriman'] ?></textarea>
								</div>
								<div class="form-group">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" id="simpanAlamat" name="simpan_alamat" value="1" checked>
										<label class="form-check-label" for="simpanAlamat">
											Simpan alamat untuk transaksi selanjutnya.
										</label>
									</div>
								</div>
	
								<div class="form-group">
									<script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
									<link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />
	
									<div id='map' style='width: 100%; height: 500px;'></div>
		
									<script src="https://npmcdn.com/@turf/turf@5.1.6/turf.min.js"></script>
									<script>
										mapboxgl.accessToken = 'pk.eyJ1IjoiZmFocnVsNDIxNSIsImEiOiJja2FlOTJyYmkwaDl2MzJtYndya2hhbjUwIn0.AqbaEqFZYd4YLlVhrSJDlw';
										
										var lngLat = [112.643591, -7.951986]; // posisi toko
	
										var map = new mapboxgl.Map({
											container:  'map',
											style:      'mapbox://styles/mapbox/streets-v11',
											center:     lngLat,
											zoom:       15,
										});
	
										var marker = new mapboxgl.Marker()
											.setLngLat(lngLat)
											.addTo(map);
									</script>
								</div>
	
								<div class="form-group">
									<h6 class="font-size-1 pt-2 mb-3">Estimasi biaya pengiriman</h6>
									<div class="row">
										<div class="col-2">
											<label class="input-label mb-1" for="distance">Jarak</label>
											<div class="text-black-100 font-weight-500">
												<input type="hidden" name="jarak" id="distance" value="<?= @$transaksi['jarak'] ?>">
												<label id="distanceLabel" class="text-center"><?= !empty(@$transaksi['jarak']) ? @$transaksi['jarak'] : 0 ?></label>
												<span>KM</span>
											</div>
										</div>
										<div class="col-4">
											<label class="input-label mb-1" for="distance">Kendaraan</span></label>
											<div class="text-black-100 font-weight-500">
												<label class="text-center"> <span><?= @$kendaraan[0] ?> - <?= idrFormat(@$kendaraan[1]) ?></label>
											</div>
										</div>
										<div class="offset-1 col-5">
											<label class="input-label mb-1" for="distance">Estimasi biaya</label>
											<input type="hidden" id="biayaKirim" name="biaya_pengiriman" value="<?= @$transaksi['biaya_pengiriman'] ?>">
											<label id="biayaKirimLabel" class="text-center text-info font-weight-500"><?= idrFormat(!empty(@$transaksi['biaya_pengiriman']) ? @$transaksi['biaya_pengiriman'] : 0) ?></label>
										</div>
									</div>
								</div>
							</div>
							<div class="pemesananTipe2" style="display:none;">
								<p>JL.Ciliwung, No.76<br>
								Malang, East Java, Indonesia</p>
							</div>
						</div>
						<div class="text-block">
							<h5 class="mb-3">Jaminan</h5>
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<select name="jaminan" class="form-control">
											<option value="KTP">KTP</option>
											<option value="SIM">SIM</option>
											<option value="Kartu Pelajar">Kartu Pelajar</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="input-label">Foto jaminan</label>
										<div class="image-area">
											<input type="file" accept="image/jpeg,image/png" id="id-image-upload" class="image-area-input" name="foto_jaminan">
											<label for="id-image-upload" tabindex="-1" class="image-area-item" style="background-image: none;">
												<div class="image-area-item-context">
													<div class="text-black-200">
														<i class="fa fa-camera d-block"></i>
														<span class="font-weight-600">Tambah foto</span>
													</div>
												</div>
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-7">
									<div class="form-group">
										<label class="input-label" for="noidentitasLabel">No. Identitas</label>
										<input type="text" class="form-control" name="no_identitas" id="noidentitasLabel" value="<?= @$transaksi['no_identitas'] ?>" required="">
									</div>
								</div>
								<div class="col-lg-5">
									<div class="form-group">
										<label class="input-label" for="signUpTelepon">No. Telepon</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="bg-white border-right-0 input-group-text">+62</span>
											</div>
											<input type="number" class="form-control" name="no_telp" id="signUpTelepon" value="<?= @$transaksi['no_telp'] ?>" required="">
										</div>
									</div>
								</div>
							</div>
						</div>
					<div class="row space-1 flex-column flex-sm-row">
						<div class="col text-center text-sm-left">
						</div>
						<div class="col text-center text-sm-right">
							<button type="submit" class="btn btn-primary px-3">
								Next step<i class="fa-chevron-right fa ml-2"></i></a>
							</button>
						</div>
					</div>
				</div>
				<div class="col-lg-5 pl-xl-5">
					<div class="card border-0 bg-light">
						<div class="card-header bg-black">
							<h5 class="m-0 text-white">Ringkasan Pesanan</h5>
						</div>
						<div class="card-body p-4">
							<div class="pb-0">
								<table class="w-100">
									<tbody>
										<tr>
											<th class="font-weight-normal py-2">Subtotal</th>
											<td class="text-right py-2"><?= idrFormat(@$subtotal) ?></td>
										</tr>
										<tr>
											<th class="font-weight-normal pt-2 pb-3 text-info">Biaya Pengiriman</th>
											<td class="text-right pt-2 pb-3 text-info">
												<label id="biayaPengirimanLabel"><?= idrFormat(@$transaksi['biaya_pengiriman']) ?></label>
											</td>
										</tr>
									</tbody>
									<tfoot>
										<tr class="border-top">
											<th class="pt-3">Total</th>
											<!-- <td class="font-weight-bold text-right pt-3">Rp <?= @$total_sewa ?></td> -->
											<td class="font-weight-bold text-right pt-3">
												<input type="hidden" id="totalSewa" name="total_harga" value="<?= @$total_sewa ?>">
												<label id="totalSewaLabel"><?= idrFormat(@$total_sewa) ?></label>
											</td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>

<script>
	var alamatContainer = document.getElementById('alamat');
	var distanceContainer = document.getElementById('distance');
	var distanceLabelContainer = document.getElementById('distanceLabel');
	var biayaKirimContainer = document.getElementById('biayaKirim');
	var biayaKirimLabelContainer = document.getElementById('biayaKirimLabel');
	var biayaPengirimanLabelContainer = document.getElementById('biayaPengirimanLabel');

	var subtotal = parseInt(<?= $subtotal ?>);
	var totalSewaContainer = document.getElementById('totalSewa');
	var totalSewaLabelContainer = document.getElementById('totalSewaLabel');

	// GeoJSON object to hold our measurement features
	var geojson = {
		'type': 'FeatureCollection',
		'features': []
	};

	// Used to draw a line between points
	var linestring = {
		'type': 'Feature',
		'geometry': {
			'type': 'LineString',
			'coordinates': []
		}
	};

	if (geojson.features.length < 1) {
		var point = {
			'type': 'Feature',
			'geometry': {
			'type': 'Point',
			'coordinates': lngLat
			},
			'properties': {
				'id': String(new Date().getTime())
			}
		};
		
		geojson.features.push(point);
	}

	map.on('load', function() {
		map.addSource('geojson', {
			'type': 'geojson',
			'data': geojson
		});
		
		// Add styles to the map
		map.addLayer({
			id: 'measure-points',
			type: 'circle',
			source: 'geojson',
			paint: {
				'circle-radius': 5,
				'circle-color': '#000'
			},
			filter: ['in', '$type', 'Point']
		});
		map.addLayer({
			id: 'measure-lines',
			type: 'line',
			source: 'geojson',
			layout: {
				'line-cap': 'round',
				'line-join': 'round'
			},
			paint: {
				'line-color': '#000',
				'line-width': 2.5
			},
			filter: ['in', '$type', 'LineString']
		});
		
		map.on('click', function(e) {
			var features = map.queryRenderedFeatures(e.point, {
				layers: ['measure-points']
			});

			// Remove the linestring from the group
			// So we can redraw it based on the points collection
			if (geojson.features.length > 1) geojson.features.pop();
			
			// If a feature was clicked, remove it from the map
			if (features.length) {
				var id = features[0].properties.id;
				geojson.features = geojson.features.filter(function(point) {
					return point.properties.id !== id;
				});
			} else {
				var point = {
					'type': 'Feature',
					'geometry': {
					'type': 'Point',
					'coordinates': [e.lngLat.lng, e.lngLat.lat]
					},
					'properties': {
						'id': String(new Date().getTime())
					}
				};
				
				geojson.features.push(point);
			}
			
			if (geojson.features.length > 1) {
				linestring.geometry.coordinates = geojson.features.map(function(point) {
					return point.geometry.coordinates;
				});
				
				geojson.features.push(linestring);
				
				// Populate the distanceContainer with total distance
				var totalDistance = parseFloat(turf.length(linestring).toLocaleString()).toFixed(1);
				distanceContainer.value = totalDistance;
				distanceLabelContainer.innerHTML = totalDistance;

				var totalBiayaPengiriman = totalDistance * parseInt(<?= @$kendaraan[1] ?>);
				biayaKirimContainer.value = totalBiayaPengiriman;				
				biayaKirimLabelContainer.innerHTML = "Rp " + totalBiayaPengiriman.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
				biayaPengirimanLabelContainer.innerHTML = "Rp " + totalBiayaPengiriman.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

				var totalSewa = subtotal + parseInt(biayaKirimContainer.value);
				totalSewaContainer.value = totalSewa;
				totalSewaLabelContainer.innerHTML = "Rp " + totalSewa.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			}
		
			map.getSource('geojson').setData(geojson);
		});
	});

	map.on('mousemove', function(e) {
		var features = map.queryRenderedFeatures(e.point, {
			layers: ['measure-points']
		});
		// UI indicator for clicking/hovering a point on the map
		map.getCanvas().style.cursor = features.length ? 'pointer' : 'crosshair';
	});

</script>

<?php $this->load->view("customer/footer.php") ?>

