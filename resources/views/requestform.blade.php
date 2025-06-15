<form action="{{ route('requestform.submit') }}" method="POST">
    @csrf
    <label for="reason">Mengapa kamu ingin menjadi developer?</label>
    <textarea name="reason" id="reason" required></textarea>
    
    <button type="submit">Ajukan Permintaan</button>
</form>
