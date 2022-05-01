<style>
  .roller .er-item {
    width: 180px;
    height: 180px;
    font-size: 14px;
    padding: 5px;
  }

</style>
<div class="container-fluid pt-4 pb-4" style="background: #f9f9fa;">
    <div class="container">
			<div class="row">
				<div class="col-lg-12">
						<div class="bg_contentlogin_reg">
                    <section class="examples example-1 text-center" style="width:100%;">
                      <div class="roller"></div>
                      <p><button type="button" class="btn btn-primary start-spin">เริ่มสุ่ม</button></p>
                    </section>
			              <div class="text-center mt-2 mb-2">
			                  <p class="text-muted mb-0">** การสุ่ม 1 ครั้งจะต้องเสีย 10 Point **</p>
			              </div>
						</div>
				</div>

						<div class="col-12 bg-white p-3">
							<h2>ประวัติการสุ่ม</h2>
							<div class="table-responsive pt-3 pb-3">
									<table id="datatable_user_random" class="table table-striped ">
										<thead>
											<tr>
												<th>#</th>
												<th class="th-sm">เกม</th>
												<th class="th-md">รางวัล</th>
												<th class="th-lg">รายละเอียด</th>
												<th class="th-lg">วันที่-เวลา</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$i = 1;
												$q = dd_q("SELECT * FROM random_history WHERE user_id = ? ORDER BY date DESC",[$_SESSION['id']]);
												while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
											?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><?php echo $row['game_name']; ?></td>
												<td><?php echo $row['item_name']; ?></td>
												<td><?php echo $row['item_detail']; ?></td>
												<td><?php echo $row['date']; ?></td>
											</tr>
											<?php $i++; } ?>
										</tbody>
									</table>
							</div>
						</div>

				</div>
    </div>
</div>
