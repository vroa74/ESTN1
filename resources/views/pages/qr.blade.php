<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        <!-- Page header -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1 class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold">{{ __('Generador de Códigos QR') }}</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">{{ __('Genera códigos QR personalizados con Endroid QR Code') }}</p>
            </div>
        </div>

        <!-- QR Generator Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            
            <!-- Generator Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ __('Generador de QR') }}</h2>
                
                <form id="qrForm" class="space-y-4">
                    @csrf
                    <div>
                        <label for="qrData" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            {{ __('Contenido del QR') }}
                        </label>
                        <input 
                            type="text" 
                            id="qrData" 
                            name="data"
                            value="https://laravel.com"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-violet-500 dark:bg-gray-700 dark:text-gray-100"
                            placeholder="{{ __('Ingresa URL, texto, etc.') }}"
                        >
                    </div>
                    
                    <button 
                        type="submit"
                        class="w-full btn bg-violet-500 hover:bg-violet-600 text-white"
                    >
                        <svg class="w-4 h-4 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        {{ __('Generar Código QR') }}
                    </button>
                </form>

                <div id="loading" class="hidden mt-4 text-center">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-violet-500"></div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">{{ __('Generando...') }}</p>
                </div>
            </div>

            <!-- QR Display Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ __('Código QR Generado') }}</h2>
                
                <div id="qrResult" class="flex items-center justify-center min-h-[300px]">
                    <div class="text-center text-gray-400 dark:text-gray-500">
                        <svg class="w-20 h-20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                        </svg>
                        <p class="text-sm">{{ __('El código QR aparecerá aquí') }}</p>
                    </div>
                </div>

                <button id="downloadBtn" class="hidden w-full mt-4 btn bg-gray-900 hover:bg-gray-800 text-white dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-white">
                    <svg class="w-4 h-4 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    {{ __('Descargar QR') }}
                </button>
            </div>

        </div>

        <!-- Examples Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ __('Ejemplos de Códigos QR') }}</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @php
                    function generateQR($data) {
                        $qrCode = new \Endroid\QrCode\QrCode(
                            data: $data,
                            encoding: new \Endroid\QrCode\Encoding\Encoding('UTF-8'),
                            errorCorrectionLevel: \Endroid\QrCode\ErrorCorrectionLevel::High,
                            size: 200,
                            margin: 10,
                            roundBlockSizeMode: \Endroid\QrCode\RoundBlockSizeMode::Margin
                        );
                        $writer = new \Endroid\QrCode\Writer\PngWriter();
                        $result = $writer->write($qrCode);
                        return base64_encode($result->getString());
                    }
                @endphp

                <!-- Example 1: URL -->
                <div class="text-center p-4 border border-gray-200 dark:border-gray-600 rounded-lg">
                    <div class="bg-white p-4 rounded-lg inline-block mb-3">
                        <img src="data:image/png;base64,{{ generateQR('https://laravel.com') }}" 
                        alt="QR Laravel" 
                        class="w-48 h-48">
                    </div>
                    <h3 class="font-semibold text-gray-800 dark:text-gray-100 mb-1">{{ __('QR de URL') }}</h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400">https://laravel.com</p>
                </div>

                <!-- Example 2: Text -->
                <div class="text-center p-4 border border-gray-200 dark:border-gray-600 rounded-lg">
                    <div class="bg-white p-4 rounded-lg inline-block mb-3">
                        <img src="data:image/png;base64,{{ generateQR('¡Hola desde Laravel!') }}" 
                        alt="QR Texto" 
                        class="w-48 h-48">
                    </div>
                    <h3 class="font-semibold text-gray-800 dark:text-gray-100 mb-1">{{ __('QR de Texto') }}</h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400">¡Hola desde Laravel!</p>
                </div>

                <!-- Example 3: Contact -->
                <div class="text-center p-4 border border-gray-200 dark:border-gray-600 rounded-lg">
                    <div class="bg-white p-4 rounded-lg inline-block mb-3">
                        <img src="data:image/png;base64,{{ generateQR('mailto:info@example.com') }}" 
                        alt="QR Email" 
                        class="w-48 h-48">
                    </div>
                    <h3 class="font-semibold text-gray-800 dark:text-gray-100 mb-1">{{ __('QR de Email') }}</h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400">mailto:info@example.com</p>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
    <script>
        document.getElementById('qrForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const loading = document.getElementById('loading');
            const qrResult = document.getElementById('qrResult');
            const downloadBtn = document.getElementById('downloadBtn');
            const formData = new FormData(this);
            
            loading.classList.remove('hidden');
            qrResult.innerHTML = '';
            downloadBtn.classList.add('hidden');
            
            try {
                const response = await fetch('{{ route('qr.generate') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                });
                
                const data = await response.json();
                
                if (data.qr) {
                    const img = document.createElement('img');
                    img.src = 'data:image/png;base64,' + data.qr;
                    img.alt = 'Código QR Generado';
                    img.className = 'max-w-full h-auto mx-auto rounded-lg shadow-lg';
                    
                    qrResult.innerHTML = '';
                    qrResult.appendChild(img);
                    
                    downloadBtn.classList.remove('hidden');
                    downloadBtn.onclick = function() {
                        const link = document.createElement('a');
                        link.href = img.src;
                        link.download = 'qr-code.png';
                        link.click();
                    };
                }
            } catch (error) {
                qrResult.innerHTML = '<p class="text-red-500">{{ __('Error al generar el código QR') }}</p>';
                console.error('Error:', error);
            } finally {
                loading.classList.add('hidden');
            }
        });
    </script>
    @endpush
</x-app-layout>
