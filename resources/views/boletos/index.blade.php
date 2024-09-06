<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Telefone</th>
        </tr>
    </thead>
    <tbody>
        @foreach($associados as $associado)
        <tr>
            <td>{{ $associado->nome }}</td>
            <td>{{ $associado->cpf }}</td>
            <td>{{ $associado->email }}</td>
            <td>{{ $associado->telefone }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
