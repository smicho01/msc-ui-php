<div class="row">
    <div class="col-12">
        <form action="index.php?c=search" method="post" id="searchbar">
            <div class="input-group mb-3">
                <input type="text"
                       class="form-control top-searchbar-input"
                       placeholder="What are you searching for ?"
                       aria-label="Wha are you searching for ?"
                       aria-describedby="button-search"
                       id="search-input"
                       required minlength="3"
                       name="searchTerm"
                       value="<?php echo isset($_SESSION['search']['searchTerm']) ? $_SESSION['search']['searchTerm'] : ''; ?>"
                >
                <button class="btn btn-primary" type="submit" id="button-search">Search</button>
            </div>
            <div >
                <input
                        class="form-check-input"
                        type="checkbox"
                        id="flexCheckDefault"
                        name="onlyCollege"
                        <?php echo isset($_SESSION['search']['onlyCollege']) && $_SESSION['search']['onlyCollege'] == true ? 'checked' : ''; ?>
                >
                <label class="form-check-label" for="flexCheckDefault">
                    Show only results from my college
                </label>
            </div>
        </form>
    </div>
</div>
<div class="divider"></div>