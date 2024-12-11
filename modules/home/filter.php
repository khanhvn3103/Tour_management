<form class="filter-tours mt-2" method="GET" action="">
    <div class="row">
        <div class="col-12">
            <h5 class="primary-color font-weight-bold">
                <i class="fa fa-filter"></i>
                Tìm kiếm
            </h5>
        </div>
    </div>
    <div class="form-group">
        <label for="startingPoint">Điểm đi</label>
        <input type="text" class="form-control" name="startingPoint" id="startingPoint" placeholder="Nhập điểm đi">
    </div>

    <div class="form-group">
        <label for="destination">Điểm đến</label>
        <input type="text" class="form-control" name="destination" id="destination" placeholder="Nhập điểm đến">
    </div>

    <div class="form-group">
        <label for="duration">Thời lượng</label>
        <select class="form-control" name="duration">
            <option value="">Chọn thời lượng</option>
            <option value="1">1-3 ngày</option>
            <option value="2">4-7 ngày</option>
            <option value="3">8-14 ngày</option>
            <option value="4">Trên 14 ngày</option>
        </select>
    </div>

    <div class="form-group">
        <label for="numberOfPeople">Số lượng người</label>
        <select class="form-control" name="numberOfPeople">
            <option value="">Chọn số lượng người</option>
            <option value="1">1 người</option>
            <option value="2">2 người</option>
            <option value="3">3-5 người</option>
            <option value="4">5+ người</option>
        </select>
    </div>

    <div class="row mt-3">
        <div class="col-5 text-end">
            <button type="reset" class="btn btn-dashed">Đặt lại</button>
        </div>
        <div class="col-7 text-start">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-search"></i>
                Tìm kiếm
            </button>
        </div>
    </div>
</form>
