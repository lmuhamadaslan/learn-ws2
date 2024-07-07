<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Add Student</title>
    <style>
        body {
            width: 100%;
            height: 80vh;
        }

        .card {
            width: 30%;
        }

        #form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>

<body>
    <section id="form">
        <div class="card">
            <div class="card-header">
                Add Student
            </div>
            <div class="card-body">
                <form id="form-student">
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                    <div class="form-group">
                        <label for="formGroupExampleInput">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            id="formGroupExampleInput" placeholder="input name">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">NIM</label>
                        <input type="text" name="nim" id="nim" class="form-control"
                            id="formGroupExampleInput2" placeholder="input name">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Department</label>
                        <input type="text" name="department" id="department" class="form-control"
                            id="formGroupExampleInput2" placeholder="input department">
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </form>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('form-student').addEventListener('submit', function(e) {
            e.preventDefault();

            const csrf = document.getElementById('token').value;
            const name = document.getElementById('name').value;
            const nim = document.getElementById('nim').value;
            const department = document.getElementById('department').value;

            axios.post('/store/student', {
                    _token: csrf,
                    name: name,
                    nim: nim,
                    department: department
                })
                .then(response => {
                    alert('success add student');
                    document.getElementById('name').value = '';
                    document.getElementById('nim').value = '';
                    document.getElementById('department').value = '';
                })
                .catch(error => {
                    console.error(error);
                })
        })
    </script>
</body>

</html>
