<!-- index.blade.php -->

<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Name</td>
          <td>Lastname</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{$student->student_id}}</td>
            <td>{{$student->name}}</td>
            <td>{{$student->last_name}}</td>
            <!-- <td><a href="{{ route('students.edit',$student->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('students.destroy', $student->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td> -->
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
