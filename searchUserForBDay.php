<?php
include('php/header.php');
?>

<div class="hero-unit" style="background-color: #e6f3f7;">
    <div class="row">
    <div class="span6 offset3">
    <h1>Search Posts</h1>
        <form accept-charset="UTF-8" action="queryUserForBDay.php" method="post"><div style="margin:0;padding:0;display:inline"></div>

            <label for="bday">Bday</label>
            <input id="bday" name="bday" size="30" type="date"/>
            
            <input class="btn btn-large btn-primary" name="submit" type="submit" value="Search" />
        </form>
  
    </div>
    </div>
</div>

<?php
include('php/footer.php');
?>
