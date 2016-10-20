<form action="/site/login" method="post">
    <label>Login</label>
    <input type="text" name="LoginForm[login]" value="<?=$form->login?>"/>
    <br/>

    <label>Password</label>
    <input type="text" name="LoginForm[password]" value="<?=$form->password?>"/>
    <br/>
    <button type="submit">Send</button>
</form>