<section style="padding-top: 7rem">
    <div class="container">
        <div class="row" id="user-information">
            <div class="col-3 d-flex flex-column align-content-center align-items-center">
                <img src="/Tour_management/asset/images/user/avatar.jpg" class="avatar"/>
                <h5 class="primary-color mt-4 font-weight-bold">Super Admin</h5>
                <h6 class="primary-color mb-5">500 Điểm</h6>

                <img src="/Tour_management/asset/images/user/award.png" style="width: 100px"/>
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
                                <label class="col-sm-2 col-form-label">Họ và tên</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="Super admin" readonly>
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <label class="col-sm-2 col-form-label">Căn cước công dân</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="098765432142" readonly>
                                </div>
                            </div>

                            <div class="col-6 mb-2">
                                <label class="col-sm-2 col-form-label">Ngày sinh</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="01/01/1998" readonly>
                                </div>
                            </div>

                            <div class="col-6 mb-2">
                                <label class="col-sm-2 col-form-label">Giới tính</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="Nam" readonly>
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <label class="col-sm-2 col-form-label">Số điện thoại</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="0123456789" readonly>
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="superadmin@gmail.com" readonly>
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
</section>