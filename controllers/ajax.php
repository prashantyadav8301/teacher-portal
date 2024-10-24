<script>
  function add_student_data() {
    if ($('#name').val() !== '' && $('#sub').val() !== '' && $('#marks').val() !== '') {
      $.ajax({
        url: "index.php",
        method: "POST",
        data: $('#add_stu_form').serialize(),
        success: function(data) {
          var data = JSON.parse(data);
          if (data.status) {
            alert(data.msg);
            location.reload();
          } else {
            alert(data.msg);
            return false
          }
        }
      });
    } else {
      alert('All fields are required.');
      return false
    }
  }

  function edit_student_data(id) {
    $("#name_" + id).prop('disabled', false).focus();
    $("#sub_" + id).prop('disabled', false);
    $("#marks_" + id).prop('disabled', false);
    $("#marks_" + id).prop('disabled', false);
    $("#edit_" + id).hide();
    $("#update_" + id).show();
  }

  function update_student_data(id, flag) {
    var name = $('#name_' + id).val();
    var sub = $('#sub_' + id).val();
    var marks = $('#marks_' + id).val();
    if (name !== '' && sub !== '' && marks !== '') {
      $.ajax({
        url: "index.php",
        method: "POST",
        data: {
          id: id,
          name: name,
          sub: sub,
          marks: marks,
          flag: flag,
          tab: 'update_stu_data_tab'
        },
        success: function(data) {
          var data = JSON.parse(data);
          if (data.status) {
            alert(data.msg);
            location.reload();
          } else {
            alert(data.msg);
            return false
          }
        }
      });
    } else {
      alert('All fields are required.');
      return false
    }
  }

  function delete_student_data(id, flag) {
    var opt = prompt("To delete this record type 'YES'");
    if (opt == 'YES') {
      $.ajax({
        url: "index.php",
        type: 'POST',
        data: {
          "id": id,
          "flag": flag,
          "tab": 'delete_stu_data_tab',
        },
        success: function(data) {
          var data = JSON.parse(data);
          if (data.msg) {
            alert(data.msg);
            location.reload();
          } else {
            alert(data.msg);
            return false
          }
        }
      });
    } else {
      location.reload();
    }
  };

  function user_login() {
    if ($('#username').val() !== '' && $('#password').val() !== '') {
      $.ajax({
        url: "index.php",
        method: "POST",
        data: $('#login_user_form').serialize(),
        success: function(data) {
          var data = JSON.parse(data);
          if (data.status) {
            alert(data.msg);
            $("input[name='flag']").val('');
            window.location = 'index.php';
          } else {
            alert(data.msg);
            return false
          }
        }
      });
    } else {
      alert('All fields are required.');
      return false
    }
  }

  function user_register() {
    if ($('#username').val() !== '' && $('#password').val() !== '' && $('#C_username').val() !== '') {
      $.ajax({
        url: "index.php",
        method: "POST",
        data: $('#user_register_form').serialize(),
        success: function(data) {
          var data = JSON.parse(data);
          if (data.status) {
            alert(data.msg);
            $("input[name='flag']").val('');
            window.location = 'index.php';
          } else {
            alert(data.msg);
            return false
          }
        }
      });
    } else {
      alert('All fields are required.');
      return false
    }
  }
</script>