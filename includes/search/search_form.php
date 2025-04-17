<div class="d-flex align-items-center p-3 my-3 text-black-50 bg-danger rounded shadow-lg">
    <img class="mr-3 img-size" src="/assets/images/fire.png" alt="">
    <div class="lh-100">
        <form method="post">
            <label class="search-container d-flex align-items-center rounded px-2">
                <input type="search" name="search_name" class="form-control border-0 flex-grow-1"
                       placeholder="Пошук..." value="<?= $_POST['search_name'] ?? '' ?>">
                <button type="submit" class="mx-2 btn text-white text-shadow">
                    <i class="fas fa-search"></i>
                </button>
            </label>
        </form>
    </div>
</div>
