<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Content-Type: application/json; charset=UTF-8");

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode([
            'success' => false,
            'error' => 'Invalid JSON received from client',
            'details' => json_last_error_msg()
        ]);
        exit;
    }

    class AIClient {
        private $apiKey;
        private $apiUrl = 'https://openrouter.ai/api/v1/chat/completions';
        private $APIModel;
        private $timeout = 300;
        private $prompt;

        public function sendRequest($data) {
            $this->prompt   = $data['prompt'];
            $this->APIModel = $data['model'] ?? 'deepseek/deepseek-chat-v3-0324:free';
            $this->apiKey   = $data['apiKey'];

            if (empty($this->apiKey)) {
                return [
                    'success' => false,
                    'error'   => 'API Key is missing.',
                    'details' => 'Please provide a valid API key.'
                ];
            }

            $requestData = [
                'model' => $this->APIModel,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $this->prompt
                    ]
                ]
            ];

            $response = $this->makeApiCall($requestData);
            return $this->parseResponse($response);
        }

        private function makeApiCall($data) {
            $ch = curl_init($this->apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->apiKey
            ]);
            curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if (curl_errno($ch)) {
                $error = curl_error($ch);
                curl_close($ch);
                return ['error' => 'CURL error: ' . $error, 'status' => 0];
            }

            curl_close($ch);
            return [
                'status' => $httpCode,
                'body' => json_decode($response, true)
            ];
        }

        private function parseResponse($response) {
            if (isset($response['error'])) {
                return [
                    'success' => false,
                    'error' => $response['error'],
                    'details' => 'A cURL error occurred during the API call.'
                ];
            }

            if ($response['status'] !== 200) {
                return [
                    'success' => false,
                    'error' => 'API request failed with HTTP status ' . $response['status'],
                    'status' => $response['status'],
                    'details' => $response['body']['error']['message'] ?? 'Unknown error from API.'
                ];
            }

            $choices = $response['body']['choices'] ?? [];
            if (empty($choices)) {
                return [
                    'success' => false,
                    'error' => 'No response from AI model or invalid structure.',
                    'details' => 'The API returned an empty or malformed response for choices.'
                ];
            }

            $content = $choices[0]['message']['content'] ?? '';
            $usage = $response['body']['usage'] ?? null;

            return [
                'success' => true,
                'response' => trim($content),
                'usage' => $usage,
                'full_response' => $response['body']
            ];
        }
    }

    $aiClient = new AIClient();
    $response = $aiClient->sendRequest($data);
    echo json_encode($response);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Chat Interface</title>
    <script src="js/tailwindcss.js"></script>
    <link rel="stylesheet" href="css/all.min.css">
    <script src="js/jquery.min.js"></script>
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .loading-dots:after {
            content: '.';
            animation: dots 1.5s steps(5, end) infinite;
        }
        @keyframes dots {
            0%, 20% { content: '.'; }
            40% { content: '..'; }
            60% { content: '...'; }
            80%, 100% { content: ''; }
        }
        .mr-2 {
            margin-right: initial !important;
			margin-left: 0.5rem;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="bg-white rounded-xl shadow-md overflow-hidden p-6 mb-8">
        <h1 class="text-2xl font-bold text-center text-indigo-600 mb-6">
            <i class="fas fa-robot mr-2"></i> رابط هوش مصنوعی
        </h1>

        <form id="ai-form">
            <div>
                <label for="model" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-brain mr-1"></i> انتخاب مدل
                </label>
                <select id="model" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                    <option value="deepseek/deepseek-chat-v3-0324:free">DeepSeek Chat v3 (رایگان)</option>
                    <option value="qwen/qwen3-coder:free">Qwen Coder (رایگان)</option>
                    <option value="moonshotai/kimi-k2:free">Kimi K2 (رایگان)</option>
                    <option value="google/gemini-2.0-flash-exp:free">Gemini 2.0 Flash (رایگان)</option>
                </select>
            </div>

            <div>
                <label for="apiKey" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-key mr-1"></i> کلید API
                </label>
                <input type="text" id="apiKey" placeholder="کلید API خود را وارد کنید"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            </div>

            <div>
                <label for="prompt" class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-comment-dots mr-1"></i> پیام شما
                </label>
                <textarea id="prompt" rows="5" placeholder="پیام خود را اینجا بنویسید..."
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"></textarea>
            </div>

            <div class="flex justify-center mt-4">
                <button id="submitBtn" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center">
                    <i class="fas fa-paper-plane mr-2"></i> ارسال درخواست
                </button>
            </div>
        </form>
    </div>

    <div id="responseContainer" class="hidden bg-white rounded-xl shadow-md overflow-hidden p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-reply mr-2 text-indigo-500"></i> پاسخ هوش مصنوعی
        </h2>
        <div id="response" class="text-gray-700 whitespace-pre-wrap"></div>
        <div id="loading" class="hidden text-indigo-500 mt-4">
            <i class="fas fa-spinner fa-spin mr-2"></i>
            <span class="loading-dots">در حال دریافت پاسخ</span>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#submitBtn').on('click', function (e) {
            e.preventDefault();

            const model = $('#model').val();
            const apiKey = $('#apiKey').val();
            const prompt = $('#prompt').val();

            const $responseContainer = $('#responseContainer');
            const $responseDiv = $('#response');
            const $loadingDiv = $('#loading');
            const $submitBtn = $('#submitBtn');

            if (!apiKey || !prompt) {
                alert('لطفاً کلید API و پیام را وارد کنید.');
                return;
            }

            $loadingDiv.removeClass('hidden');
            $responseDiv.text('');
            $responseContainer.removeClass('hidden');
            $submitBtn.prop('disabled', true);
            $submitBtn.html('<i class="fas fa-spinner fa-spin mr-2"></i> در حال پردازش...');

            $.ajax({
                url: window.location.href,
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({ model, apiKey, prompt }),
                success: function (response) {
                    console.dir(response);
                    if (response.error) {
                        $responseDiv.text('خطا: ' + (response.details || response.error)).addClass('text-red-500');
                    } else if (response.success) {
                        $responseDiv.text(response.response).addClass('fade-in');
                    } else {
                        $responseDiv.text('پاسخ نامشخصی از سرور دریافت شد.').addClass('text-red-500');
                    }
                },
                error: function (xhr, status, error) {
                    console.error("خطای AJAX:", status, error);
                    console.log("پاسخ سرور:", xhr.responseText);
                    $responseDiv.text('خطا در ارتباط با سرور یا پاسخ نامعتبر دریافت شد.').addClass('text-red-500');
                },
                complete: function () {
                    $loadingDiv.addClass('hidden');
                    $submitBtn.prop('disabled', false);
                    $submitBtn.html('<i class="fas fa-paper-plane mr-2"></i> ارسال درخواست');
                }
            });
        });
    });
</script>
</body>
</html>
