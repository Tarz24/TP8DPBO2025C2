<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">Detail Mata Kuliah</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-12 d-flex justify-content-end">
                        <a href="/course/index" class="btn btn-secondary me-2">Kembali</a>
                        <a href="/course/edit/<?= $course_data['id'] ?>" class="btn btn-warning">Edit</a>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <th>Kode Mata Kuliah</th>
                                <td><?= htmlspecialchars($course_data['course_code']) ?></td>
                            </tr>
                            <tr>
                                <th>Nama Mata Kuliah</th>
                                <td><?= htmlspecialchars($course_data['course_name']) ?></td>
                            </tr>
                            <tr>
                                <th>SKS</th>
                                <td><?= $course_data['credits'] ?></td>
                            </tr>
                            <tr>
                                <th>Semester</th>
                                <td><?= $course_data['semester'] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Mahasiswa Terdaftar</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Nilai</th>
                                <th>Tanggal Enrollment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($students->num_rows > 0) : ?>
                                <?php while ($row = $students->fetch_assoc()) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['nim']) ?></td>
                                        <td>
                                            <a href="/student/view/<?= $row['id'] ?>">
                                                <?= htmlspecialchars($row['name']) ?>
                                            </a>
                                        </td>
                                        <td><?= $row['grade'] ? htmlspecialchars($row['grade']) : 'Belum ada nilai' ?></td>
                                        <td><?= date('d M Y', strtotime($row['enrollment_date'])) ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada mahasiswa yang terdaftar</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>