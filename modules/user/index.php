<section style="padding-top: 7rem">
    <?php
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        ?>
        <div class="container">
            <div class="row" id="user-information">
                <div class="col-3 d-flex flex-column align-content-center align-items-center">
                    <img src="https://www.clipartmax.com/png/small/30-301819_tourist-travel-icon-png.png" alt="Tourist Travel" class="avatar" />
                    <h5 class="primary-color mt-4 font-weight-bold"><?php echo htmlspecialchars($user['fullName']); ?></h5>
                    <h6 class="primary-color mb-5">500 Điểm</h6>
                    <img src="/Tour_management/asset/images/user/award.png" style="width: 100px" alt="Gold Member Award" />
                    <p class="primary-color">Thành viên vàng</p>
                </div>
                <div class="col-9">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                                Thông tin cá nhân
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                Lịch sử Tour
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <label class="col-sm-2 col-form-label">Tên đầy đủ</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="Super admin" readonly>
                                    </div>
                                </div>

                                <div class="col-12 mb-2">
                                    <label class="col-sm-2 col-form-label">Căn cước công dân</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['identifyCard']); ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-6 mb-2">
                                    <label class="col-sm-2 col-form-label">Ngày sinh</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['dob']); ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-6 mb-2">
                                    <label class="col-sm-2 col-form-label">Giới tính</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?php echo $user['gender'] == 1 ? "Nam" : "Nữ"; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-12 mb-2">
                                    <label class="col-sm-2 col-form-label">Số điện thoại</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['phone']); ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            Lịch sử Tour
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</section>
