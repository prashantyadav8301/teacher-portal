<?php
require_once 'controllers/auth.php';
protectRoute();
?>

<?php
include_once 'db/db.php';
$sql = "SELECT * FROM students";
$res = $conn->query($sql);
?>

<!-- Table Section -->
<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-body  table-responsive">
      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th>Name</th>
            <th>Subject</th>
            <th>Mark</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($res->num_rows > 0): ?>
            <?php while ($row = $res->fetch_assoc()): ?>
              <tr>
                <td>
                  <div class="avatar-circle"><?= strtoupper($row['name'][0]) ?? '#'; ?></div>
                  <input type="text" name="name_<?= $row['id']; ?>" id="name_<?= $row['id']; ?>" value="<?= $row['name']; ?>" disabled>
                </td>
                <td><input type="text" name="sub_<?= $row['id']; ?>" id="sub_<?= $row['id']; ?>" value="<?= $row['sub']; ?>" disabled></td>
                <td><input type="text" name="marks_<?= $row['id']; ?>" id="marks_<?= $row['id']; ?>" value="<?= $row['marks']; ?>" disabled></td>
                <td>
                  <div class="d-grid gap-4 d-md-block">
                    <input title="Edit button" style="padding: .375rem 1.5rem;" class="btn btn-info" type="button" name="edit" value="Edit" id="edit_<?= $row["id"]; ?>" onclick="edit_student_data(<?= $row['id']; ?>);" />

                    <input style="display:none" title="Update button" style="padding: .375rem 1.5rem;" class="btn btn-secondary" type="button" name="update" value="Update" id="update_<?= $row["id"]; ?>" onclick="update_student_data(<?= $row['id']; ?>, 'update_stu_data_flag');" />

                    <input title="Delete button" style="padding: .375rem 0.86rem;" class="btn btn-danger" type="button" name="button" value="Delete" onclick="delete_student_data(<?= $row['id']; ?>, 'delete_stu_data_flag');" />
                  </div>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="text-danger">No data found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>

      <input title="Add students data button" class="btn btn-dark mt-3" type="button" name="button" value="Add students data" data-bs-toggle="modal" data-bs-target="#addProductModal" />
    </div>
  </div>
</div>

<!-- Add Modal HTML -->
<div id="addProductModal" class="modal fade">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form method="post" action="index.php" id="add_stu_form">
        <div class="modal-header">
          <h2 class="modal-title">Add Student</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3 stu-det">
            <label for="name">Name</label>
            <div class="input-icon">
              <i class="fa fa-user"></i>
              <input type="text" id="name" name="name" placeholder="Enter Name">
            </div>
          </div>
          <div class="mb-3 stu-det">
            <label for="sub">Subject</label>
            <div class="input-icon">
              <i class="fa fa-book"></i>
              <input type="text" id="sub" name="sub" placeholder="Enter Subject">
            </div>
          </div>
          <div class="mb-3 stu-det">
            <label for="mark">Mark</label>
            <div class="input-icon">
              <i class="fa fa-bookmark"></i>
              <input type="number" id="marks" name="marks" placeholder="Enter Mark">
            </div>
          </div>
          <input type="hidden" name="flag" value="add_student_data_flag">
          <input type="hidden" name="tab" value="add_student_data_tab">
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-info" value="Save" name="submit" onclick="add_student_data();">
          <input type="button" class="btn btn-default" data-bs-dismiss="modal" value="Cancel">
        </div>
      </form>
    </div>
  </div>
</div>

<?php include_once "controllers/ajax.php"; ?>