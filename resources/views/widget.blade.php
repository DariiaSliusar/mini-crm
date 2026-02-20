<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Widget</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Submit a Ticket</h2>

    <form id="ticket-form" enctype="multipart/form-data" class="flex flex-col gap-4">
        <input type="text" name="name" placeholder="Your Name"
               class="w-full px-4 py-2 border border-gray-500 rounded-lg" required>

        <input type="email" name="email" placeholder="Email"
               class="w-full px-4 py-2 border border-gray-500 rounded-lg" required>

        <input type="tel" name="phone" placeholder="+380XXXXXXXXX"
               class="w-full px-4 py-2 border border-gray-500 rounded-lg" required>

        <input type="text" name="subject" placeholder="Subject"
               class="w-full px-4 py-2 border border-gray-500 rounded-lg" required>

        <textarea name="message" placeholder="Your message" rows="4"
                  class="w-full px-4 py-2 border border-gray-500 rounded-lg resize-none" required></textarea>

        <div class="text-sm text-gray-600">
            <label class="block mb-1 font-medium" for="files">Attach files (multiple possible):</label>
            <input type="file" id="files" name="file[]" multiple
                   class="w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
            Submit
        </button>
    </form>

    <div id="response-message" class="mt-4 hidden p-3 rounded text-center"></div>
</div>

<script>
    document.getElementById('ticket-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        const msgDiv = document.getElementById('response-message');

        try {
            const response = await fetch('/api/tickets', {
                method: 'POST',
                body: formData,
                headers: { 'Accept': 'application/json' }
            });

            const result = await response.json();

            if (response.ok) {
                msgDiv.innerText = result.message;
                msgDiv.className = 'mt-4 p-3 rounded text-center bg-green-100 text-green-700';
                form.reset();
            } else {
                msgDiv.innerText = result.message || 'Validation error';
                msgDiv.className = 'mt-4 p-3 rounded text-center bg-red-100 text-red-700';
            }
            msgDiv.classList.remove('hidden');
        } catch (error) {
            console.error('Error:', error);
        }
    });
</script>

</body>
</html>
