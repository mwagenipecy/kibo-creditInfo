<h1>Employees</h1>
<ul>
    @foreach ($this->employees as $employee)
        <li>
            <a href="{{ route('employees.show', $employee->id) }}">{{ $employee->name }}</a>
        </li>
    @endforeach
</ul>
<a href="{{ route('employees.create') }}">Add New Employee</a>
@foreach ($employees as $employee)
    <div>
        <h2>{{ $employee->name }}</h2>

        <p>{{ $employee->email }}</p>

        <h3>Absences</h3>
        <ul>
            @foreach ($employee->absences as $absence)
                <li>
                    {{ $absence->absence_date }}: {{ $absence->absence_reason }}
                </li>
            @endforeach
        </ul>

        <h3>Benefits</h3>
        <ul>
            @foreach ($employee->benefits as $benefit)
                <li>
                    Pension Plan: {{ $benefit->pension_plan }}<br>
                    Medical Insurance: {{ $benefit->medical_insurance }}<br>
                    Maternity Leave: {{ $benefit->maternity_leave }}<br>
                    Sick Leave: {{ $benefit->sick_leave }}<br>
                    Vacation: {{ $benefit->vacation }}
                </li>
            @endforeach
        </ul>
        <h3>Bonuses</h3>
        <ul>
            @foreach ($employee->bonuses as $bonus)
                <li>
                    {{ $bonus->amount }} on {{ $bonus->date }}
                </li>
            @endforeach
        </ul>
    </div>
@endforeach

