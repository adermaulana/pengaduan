<?php

include '../koneksi.php';

session_start();

if($_SESSION['status'] != 'login'){

    session_unset();
    session_destroy();

    header("location:../");

}


if(isset($_GET['hal']) == "hapus"){

	$hapus = mysqli_query($koneksi, "DELETE FROM pengaduan WHERE id = '$_GET[id]'");
  
	if($hapus){
		echo "<script>
		alert('Hapus data sukses!');
		document.location='pengaduan.php';
		</script>";
	}
  }


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<title>Admin</title>

	<link href="../assets/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
	<style>
	#modalMap {
		width: 100%;
		border-radius: 8px;
		border: 2px solid #ddd;
	}
	#locationInfo {
		padding: 10px;
		background: #f8f9fa;
		border-radius: 4px;
		margin-bottom: 15px;
	}

	#fotoInfo {
    padding: 15px;
    background: #f8f9fa;
    border-radius: 4px;
    margin-bottom: 15px;
	}

	#modalFoto {
		border-radius: 8px;
		box-shadow: 0 0 10px rgba(0,0,0,0.1);
	}
	</style>
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
          <span class="align-middle">AdminKit</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="index.php">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pengaduan.php">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Pengaduan</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="kategori.php">
              <i class="align-middle" data-feather="book"></i> <span class="align-middle">Kategori</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="laporan.php">
              <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Laporan</span>
            </a>
					</li>

					<!-- <li class="sidebar-item">
						<a class="sidebar-link" href="pages-blank.html">
							<i class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>
						</a>
					</li> -->
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell"></i>
									<span class="indicator">4</span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									4 New Notifications
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-danger" data-feather="alert-circle"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Update completed</div>
												<div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
												<div class="text-muted small mt-1">30m ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-warning" data-feather="bell"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Lorem ipsum</div>
												<div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-primary" data-feather="home"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Login from 192.186.1.8</div>
												<div class="text-muted small mt-1">5h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-success" data-feather="user-plus"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">New connection</div>
												<div class="text-muted small mt-1">Christina accepted your request.</div>
												<div class="text-muted small mt-1">14h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all notifications</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="message-square"></i>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
								<div class="dropdown-menu-header">
									<div class="position-relative">
										4 New Messages
									</div>
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Vanessa Tucker</div>
												<div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
												<div class="text-muted small mt-1">15m ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" alt="William Harris">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">William Harris</div>
												<div class="text-muted small mt-1">Curabitur ligula sapien euismod vitae.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-4.jpg" class="avatar img-fluid rounded-circle" alt="Christina Mason">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Christina Mason</div>
												<div class="text-muted small mt-1">Pellentesque auctor neque nec urna.</div>
												<div class="text-muted small mt-1">4h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Sharon Lessman</div>
												<div class="text-muted small mt-1">Aenean tellus metus, bibendum sed, posuere ac, mattis non.</div>
												<div class="text-muted small mt-1">5h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all messages</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <img src="../assets/img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark"><span class="text-dark"><?= $_SESSION['nama_admin'] ?></span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
	
								<a class="dropdown-item" href="hapusSession.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">
					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Data Pengaduan</h1>
					</div>
					<div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="card">
								<div class="card-body">
                                <table class="table table-hover my-0">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Warga</th>
											<th>NIK</th>
											<th>Tanggal Pengaduan</th>
											<th>Kategori Pengaduan</th>
											<th>Isi Pengaduan</th>
											<th>Status</th>
											<th>Foto</th>
											<th>Map</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
                                        $no = 1;
                                        $tampil = mysqli_query($koneksi, "SELECT pengaduan.*, kategori.nama as nama_kategori
                                                                        FROM pengaduan JOIN kategori ON pengaduan.id_kategori = kategori.id ORDER BY id DESC");
                                        while($data = mysqli_fetch_array($tampil)):
                                    ?>
										<tr>
											<td><?= $no ?></td>
											<td><?= $data['nama'] ?></td>
											<td><?= $data['nik'] ?></td>
											<td><?= $data['tanggal'] ?></td>
											<td><?= $data['nama_kategori'] ?></td>
											<td><?= $data['isi_pengaduan'] ?></td>
											<?php if ($data['status'] === 'Belum Dikonfirmasi'): ?>
											<td><span class="badge bg-warning"><?= $data['status'] ?></span></td>
											<?php else: ?>
											<td><span class="badge bg-success"><?= $data['status'] ?></span></td>
											<?php  endif ?>
											<td>
												<button type="button" class="btn btn-info btn-sm" 
														onclick="showFoto('<?= $data['gambar'] ?>', '<?= $data['nama'] ?>', '<?= $data['alamat_lokasi'] ?>', '<?= $data['isi_pengaduan'] ?>')">
													<i class="fas fa-image"></i> Lihat Foto
												</button>
											</td>
											<td>
												<button type="button" class="btn btn-primary btn-sm" 
														onclick="showMap(<?= $data['latitude'] ?>, <?= $data['longitude'] ?>, '<?= $data['nama'] ?>', '<?= $data['alamat_lokasi'] ?>')">
													<i class="fas fa-map-marker-alt"></i> Lihat Maps
												</button>
											</td>
											<td>
											<?php if ($data['status'] === 'Belum Dikonfirmasi'): ?>
												<a href="konfirmasi.php?id=<?= $data['id']?>" onclick="return confirm('Apakah Anda Yakin Ingin Konfirmasi Data?')" class="btn btn-success">Konfirmasi</a>
                                                <a href="pengaduan.php?hal=hapus&id=<?= $data['id']?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data?')" class="btn btn-danger">Hapus</a>
											<?php else: ?>
											<span class="badge bg-primary">Selesai</span>
											<?php  endif ?>
                                            </td>
										</tr>
                                        <?php
                                            endwhile; 
                                        ?>
									</tbody>
								</table>

								<div class="modal fade" id="mapsModal" tabindex="-1" aria-labelledby="mapsModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="mapsModalLabel">Lokasi Pengaduan</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<div id="locationInfo" class="mb-3"></div>
												<div id="modalMap" style="height: 400px;"></div>
											</div>
										</div>
									</div>
								</div>

								<div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="fotoModalLabel">Foto Pengaduan</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											<div class="modal-body">
												<div id="fotoInfo" class="mb-3"></div>
												<div class="text-center">
													<img id="modalFoto" class="img-fluid" alt="Foto Pengaduan" style="max-height: 500px;">
												</div>
											</div>
										</div>
									</div>
								</div>

								</div>
							</div>
                        </div>
                    </div>
				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin Template</strong></a>								&copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="../assets/js/app.js"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			var gradient = ctx.createLinearGradient(0, 0, 0, 225);
			gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
			gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "line",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Sales ($)",
						fill: true,
						backgroundColor: gradient,
						borderColor: window.theme.primary,
						data: [
							2115,
							1562,
							1584,
							1892,
							1587,
							1923,
							2566,
							2448,
							2805,
							3438,
							2917,
							3327
						]
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1000
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: "pie",
				data: {
					labels: ["Chrome", "Firefox", "IE"],
					datasets: [{
						data: [4306, 3801, 1689],
						backgroundColor: [
							window.theme.primary,
							window.theme.warning,
							window.theme.danger
						],
						borderWidth: 5
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					cutoutPercentage: 75
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Bar chart
			new Chart(document.getElementById("chartjs-dashboard-bar"), {
				type: "bar",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "This year",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
						barPercentage: .75,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var markers = [{
					coords: [31.230391, 121.473701],
					name: "Shanghai"
				},
				{
					coords: [28.704060, 77.102493],
					name: "Delhi"
				},
				{
					coords: [6.524379, 3.379206],
					name: "Lagos"
				},
				{
					coords: [35.689487, 139.691711],
					name: "Tokyo"
				},
				{
					coords: [23.129110, 113.264381],
					name: "Guangzhou"
				},
				{
					coords: [40.7127837, -74.0059413],
					name: "New York"
				},
				{
					coords: [34.052235, -118.243683],
					name: "Los Angeles"
				},
				{
					coords: [41.878113, -87.629799],
					name: "Chicago"
				},
				{
					coords: [51.507351, -0.127758],
					name: "London"
				},
				{
					coords: [40.416775, -3.703790],
					name: "Madrid "
				}
			];
			var map = new jsVectorMap({
				map: "world",
				selector: "#world_map",
				zoomButtons: true,
				markers: markers,
				markerStyle: {
					initial: {
						r: 9,
						strokeWidth: 7,
						stokeOpacity: .4,
						fill: window.theme.primary
					},
					hover: {
						fill: window.theme.primary,
						stroke: window.theme.primary
					}
				},
				zoomOnScroll: false
			});
			window.addEventListener("resize", () => {
				map.updateSize();
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
			var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
			document.getElementById("datetimepicker-dashboard").flatpickr({
				inline: true,
				prevArrow: "<span title=\"Previous month\">&laquo;</span>",
				nextArrow: "<span title=\"Next month\">&raquo;</span>",
				defaultDate: defaultDate
			});
		});
	</script>

	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
	
	<script>
let modalMap;
let modalMarker;

function showMap(lat, lng, nama, alamat) {
    // Tampilkan modal
    const mapsModal = new bootstrap.Modal(document.getElementById('mapsModal'));
    mapsModal.show();
    
    // Update info lokasi
    document.getElementById('locationInfo').innerHTML = `
        <strong>Pelapor:</strong> ${nama}<br>
        <strong>Alamat:</strong> ${alamat}<br>
        <strong>Koordinat:</strong> ${lat}, ${lng}
    `;

    // Inisialisasi peta jika belum ada
    if (!modalMap) {
        modalMap = L.map('modalMap');
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(modalMap);
    }

    // Set view ke lokasi yang dipilih
    modalMap.setView([lat, lng], 15);

    // Hapus marker lama jika ada
    if (modalMarker) {
        modalMap.removeLayer(modalMarker);
    }

    // Tambah marker baru
    modalMarker = L.marker([lat, lng]).addTo(modalMap)
        .bindPopup(`<b>${nama}</b><br>${alamat}`).openPopup();

    // Perbaiki tampilan peta setelah modal muncul
    setTimeout(() => {
        modalMap.invalidateSize();
    }, 250);
}

function showFoto(gambar, nama, alamat, isiPengaduan) {
    // Tampilkan modal
    const fotoModal = new bootstrap.Modal(document.getElementById('fotoModal'));
    fotoModal.show();
    
    // Update info pengaduan
    document.getElementById('fotoInfo').innerHTML = `
        <strong>Pelapor:</strong> ${nama}<br>
        <strong>Alamat:</strong> ${alamat}<br>
        <strong>Isi Pengaduan:</strong> ${isiPengaduan}
    `;

    // Update source gambar
    document.getElementById('modalFoto').src = '../uploads/' + gambar;
}

// Reset modal saat ditutup
document.getElementById('fotoModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('modalFoto').src = '';
});

// Reset modal saat ditutup
document.getElementById('mapsModal').addEventListener('hidden.bs.modal', function () {
    if (modalMap) {
        modalMap.remove();
        modalMap = null;
    }
});

</script>

</body>

</html>