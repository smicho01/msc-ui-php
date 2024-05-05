<div class="col-12 page-content">
   <div class="row">
       <div class="col-12 heading">
           <h3>Profile Update</h3>
           <p>Seems like your profile require some information. Please fill in all required fields.We offer anonymity.
               You can change your username, which will be visible to others.</p>
       </div>
   </div>

    <div class="row">
        <form>
            <div class="form-group">

                <div class="form-group">
                    <label for="exampleInputEmail1">Pick username you want to use:</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <?php foreach ($generatedUserNames as $username): ?>
                        <option><?php echo $username; ?></option>
                       <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Confirm selection</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</div>



