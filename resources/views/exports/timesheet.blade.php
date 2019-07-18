<table>
    {{-- <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead> --}}
    <tbody>

        <tr>
            <td>{{ $construction->name }}</td>
        </tr>

        <tr>
            @foreach ($construction->job as $job)
                <td>{{ $job->name }}</td>
            @endforeach
        </tr>

    </tbody>
</table>
