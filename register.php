

<form action="index.php?p=home" method="post" name="formReg" onsubmit='return validate()' id="formReg">

    <h1 id="registerTitle">Register Form</h1>

    <div class="divLog">
        <span class="spanLog"><label for="userName">User name or nick: </label></span>
        <span class="spanLog"><input type="text" id="userName" name="userName" required maxlength="18" minlength="1"/></span>
    </div>

    <div class="divLog">
        <span class="spanLog"><label for="age">Age: </label></span>
        <span class="spanLog"><input type="number" id="age" name="age" required maxlength="3" min="0" max="150"></span>
    </div>

    <div class="divLog">
        <span class="spanLog"><label for="pass1">Password: </label></span>
        <span class="spanLog"><input type="password" id="pass1" name="pass1" required maxlength="18" minlength="8"></span>
    </div>

    <div class="divLog">
        <span class="spanLog"><label for="pass2">Confirm password: </label></span>
        <span class="spanLog"><input type="password" id="pass2" name="pass2" required maxlength="18" minlength="8"></span>
    </div>

    <div class="divLog">
        <span class="spanLog"><label for="email">E-mail: </label></span>
        <span class="spanLog"><input type="email" id="email" name="email" required placeholder="test@test.com"></span>
    </div>

    <div class="divLog">
        <span class="spanLog"><input type="submit" value="Submit" name="submitData" id="submitData"></span>
    </div>

</form>