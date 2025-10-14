<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte del Alumno - {{ $reporte->student->full_name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .school-name {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .school-address {
            font-size: 11px;
            margin-bottom: 5px;
        }

        .report-title {
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 20px;
        }

        .form-section {
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            margin-bottom: 15px;
            align-items: center;
        }

        .form-label {
            font-weight: bold;
            margin-right: 10px;
            min-width: 120px;
        }

        .form-field {
            border-bottom: 1px solid #000;
            flex: 1;
            padding: 2px 5px;
            min-height: 20px;
        }

        .description-box {
            border: 1px solid #000;
            min-height: 120px;
            padding: 10px;
            margin-top: 10px;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .signature-box {
            text-align: center;
            width: 200px;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            height: 30px;
            margin-bottom: 5px;
        }

        .signature-label {
            font-size: 10px;
            font-weight: bold;
        }

        .student-info {
            background-color: #f5f5f5;
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        .info-row {
            display: flex;
            margin-bottom: 5px;
        }

        .info-label {
            font-weight: bold;
            width: 120px;
        }

        @media print {
            body {
                margin: 0;
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <!-- Encabezado -->
    <div class="header">
        <div class="school-name">Escuela Secundaria Técnica N°1</div>
        <div class="school-address">Av. Juan de la barrera No. 9 frente Unid. Hab. FOVI</div>
        <div class="school-address">San Francisco de Campeche, Campeche</div>
        <div class="report-title">REPORTE DEL ALUMNO</div>
    </div>

    <!-- Información del formulario -->
    <div class="form-section">
        <div class="form-row">
            <span class="form-label">FECHA:</span>
            <span class="form-field">{{ $reporte->fecha_reporte->format('d') }}</span>
            <span class="form-label" style="margin-left: 20px;">de</span>
            <span class="form-field" style="margin-left: 10px;">{{ $reporte->fecha_reporte->format('F') }}</span>
            <span class="form-label" style="margin-left: 20px;">de 20</span>
            <span class="form-field" style="margin-left: 10px;">{{ $reporte->fecha_reporte->format('y') }}</span>
        </div>

        <div class="form-row">
            <span class="form-label">C. Profr. (a):</span>
            <span class="form-field">{{ $reporte->profesor->name }}</span>
        </div>

        <div class="form-row">
            <span class="form-label">MATERIA:</span>
            <span class="form-field">{{ $reporte->materia }}</span>
        </div>

        <div class="form-row">
            <span class="form-label">Manifiesta que el alumno (a):</span>
            <span class="form-field">{{ $reporte->student->full_name }}</span>
            <span class="form-label" style="margin-left: 20px;">Grado, Grupo:</span>
            <span class="form-field" style="margin-left: 10px;">{{ $reporte->student->grado }}°
                {{ $reporte->student->grupo }}</span>
        </div>
    </div>

    <!-- Información adicional del estudiante -->
    <div class="student-info">
        <div class="info-row">
            <span class="info-label">Matrícula:</span>
            <span>{{ $reporte->student->matricula ?? 'N/A' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Sexo:</span>
            <span>{{ $reporte->student->sexo == 'F' ? 'Femenino' : 'Masculino' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Email:</span>
            <span>{{ $reporte->student->email ?? 'N/A' }}</span>
        </div>
    </div>

    <!-- Descripción del reporte -->
    <div class="form-section">
        <div class="form-label" style="font-weight: bold; margin-bottom: 10px;">DESCRIPCIÓN DEL REPORTE:</div>
        <div class="description-box">
            {{ $reporte->descripcion_reporte }}
        </div>
    </div>

    <!-- Observaciones si existen -->
    @if ($reporte->observaciones)
        <div class="form-section">
            <div class="form-label" style="font-weight: bold; margin-bottom: 10px;">OBSERVACIONES ADICIONALES:</div>
            <div class="description-box">
                {{ $reporte->observaciones }}
            </div>
        </div>
    @endif

    <!-- Firmas -->
    <div class="signatures">
        <div class="signature-box">
            <div class="signature-line"></div>
            <div class="signature-label">Firma del Profesor (a)</div>
            @if ($reporte->profesor)
                <div style="font-size: 10px; margin-top: 5px;">{{ $reporte->profesor->name }}</div>
            @endif
        </div>

        <div class="signature-box">
            <div class="signature-line"></div>
            <div class="signature-label">Firma del Prefecto</div>
            @if ($reporte->prefecto && $reporte->firma_prefecto_at)
                <div style="font-size: 10px; margin-top: 5px;">{{ $reporte->prefecto->name }}</div>
                <div style="font-size: 9px; margin-top: 2px;">{{ $reporte->firma_prefecto_at->format('d/m/Y H:i') }}
                </div>
            @endif
        </div>

        <div class="signature-box">
            <div class="signature-line"></div>
            <div class="signature-label">Trabajo Social</div>
            @if ($reporte->trabajadorSocial && $reporte->firma_trabajo_social_at)
                <div style="font-size: 10px; margin-top: 5px;">{{ $reporte->trabajadorSocial->name }}</div>
                <div style="font-size: 9px; margin-top: 2px;">
                    {{ $reporte->firma_trabajo_social_at->format('d/m/Y H:i') }}</div>
            @endif
        </div>
    </div>

    <!-- Información del sistema -->
    <div style="margin-top: 40px; font-size: 10px; color: #666; text-align: center;">
        <div>Reporte generado el {{ now()->format('d/m/Y H:i:s') }}</div>
        <div>ID del Reporte: {{ $reporte->id }} | Versión: {{ $reporte->version }}</div>
        <div>Estado: {{ ucfirst(str_replace('_', ' ', $reporte->estado)) }}</div>
    </div>

    <script>
        // Auto-print cuando se carga la página (opcional)
        // window.onload = function() { window.print(); }
    </script>
</body>

</html>
