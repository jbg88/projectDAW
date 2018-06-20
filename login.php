<form action="index.php?p=home" method="post" name="formReg" onsubmit='return validate2()' id="formLog">

    <h1 id="logTitle">Log In Form</h1>

    <div class="divLog">
        <span class="spanLog"><label for="nick">User name or nick: </label></span>
        <span class="spanLog"><input type="text" id="nick" name="nick" required maxlength="18" minlength="2"/></span>
    </div>

    <div class="divLog">
        <span class="spanLog"><label for="passLog">Password: </label></span>
        <span class="spanLog"><input type="password" id="passLog" name="passLog" required maxlength="18" minlength="8"></span>
    </div>

    <div class="divLog">
        <span class="spanLog"><input type="submit" value="Log In" name="logData" id="logData"></span>
    </div>

</form>