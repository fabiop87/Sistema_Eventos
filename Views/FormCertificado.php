<form action='../gerarCertificado.php' method='POST'>
    <input type='hidden' name='idAluno' value='$idAluno'>
    <input type='hidden' name='idEvento' value='$idEvento'>
    <input type='hidden' name='nomeEvento' value='$nomeEvento'>
    <input type='hidden' name='local' value='$local'>
    <input type='hidden' name='horarioInicio' value='$horarioInicio'>
    <input type='hidden' name='horarioTermino' value='$horarioTermino'>
    <button type='submit' class='btn btn-primary'>Gerar Certificado</button>
</form>