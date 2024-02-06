<?php include('function.php') ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="">
        <input type="hidden" name="" id="uid"><br><br>
        <input type="text" name="" id="name"><br><br>
        <input type="email" name="" id="email"><br>
        <input type="password" name="" id="password"><br>
        <br>
        <input type="submit" id="add">
    </form>

    <h1>Information</h1>
    <table border="">
        <thead>
            <tr>
                <td>Id</td>
                <td>Name</td>
                <td>Email</td>
                <td colspan="2">Action</td>

            </tr>
        </thead>
        <tbody id="user"></tbody>
    </table>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>

    $(document).ready(function () {
        showAll()
    })


    $(document).on('click', '#add', function (e) {
        e.preventDefault()
        var name = $('#name').val()
        var email = $('#email').val()
        var password = $('#password').val()
        $.ajax({
            url: "index.php",
            method: 'POST',
            data: { ins: 1, name: name, email: email, password: password },
            dataType: "json",
            success: function (data) {
                showAll()

            }

        });

    })


    $(document).on('click', '.deleteData', function (e) {
        e.preventDefault()
        var id = $(this).attr('id')

        $.ajax({
            url: "index.php",
            method: 'GET',
            data: { del: 1, id: id },
            dataType: "json",
            success: function (data) {

                showAll()

            }

        });

    })
    $(document).on('click', '.editData', function (e) {
        e.preventDefault()
        var id = $(this).attr('id')

        $.ajax({
            url: "index.php",
            method: 'GET',
            data: { eid: 1, id: id },
            dataType: "json",
            success: function (data) {
                $('#uid').val(data.id)
                $('#name').val(data.name)
                $('#email').val(data.email)
                $('#password').val(data.password)
                $('#add').val('update')
                $('#add').attr('id', 'update')

            }

        });

    })
    $(document).on('click', '#update', function (e) {
        e.preventDefault()

        var uid = $('#uid').val()
        var name = $('#name').val()
        var email = $('#email').val()
        var password = $('#password').val()
        $.ajax({
            url: "index.php",
            method: 'POST',
            data: { upd: 1, uid: uid, name: name, email: email, password: password },
            dataType: "json",
            success: function (data) {
                $('#uid').val("")
                $('#name').val("")
                $('#email').val("")
                $('#password').val("")
                $('#update').val('add')
                $('#update').attr('id', 'add')
                showAll()

            }

        });

    })
    function showAll() {
        $('#user').empty()
        $.ajax({
            url: "index.php",
            method: 'GET',
            data: { sel: 1 },
            dataType: "json",
            success: function (data) {
                var html = ""
                for (const st of data) {
                    html += `<tr>
                            <td>${st.id}</td>
                            <td>${st.name}</td>
                            <td>${st.email}</td>
                            <td>
                                <a href="" class="deleteData" id="${st.id}">DELETE</a>
                            </td>
                            <td>
                                <a href="" class="editData" id="${st.id}">EDIT</a>
                            </td>
                    </tr>`

                }
                $('#user').append(html)
            }

        });
    }


</script>