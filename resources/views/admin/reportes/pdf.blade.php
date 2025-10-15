<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte del Alumno - {{ $reporte->student->full_name }}</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 8px;
            line-height: 1.2;
            margin: 0;
            padding: 0;
            color: #000;
        }

        .report-copy {
            width: 100%;
            height: 50vh;
            padding: 8px;
            page-break-after: avoid;
            position: relative;
        }

        .report-copy:first-child {
            border-bottom: 1px dashed #000;
        }

        .header {
            text-align: center;
            margin-bottom: 8px;
        }

        .school-name {
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .school-address {
            font-size: 7px;
            margin-bottom: 2px;
        }

        .report-title {
            font-size: 11px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 8px;
        }

        .form-section {
            margin-bottom: 8px;
        }

        .form-row {
            display: flex;
            margin-bottom: 5px;
            align-items: center;
            font-size: 7px;
        }

        .form-label {
            font-weight: bold;
            margin-right: 5px;
            white-space: nowrap;
        }

        .form-field {
            border-bottom: 1px solid #000;
            flex: 1;
            padding: 1px 3px;
            min-height: 12px;
            font-size: 7px;
        }

        .description-box {
            border: 1px solid #000;
            min-height: 60px;
            padding: 5px;
            margin-top: 5px;
            font-size: 7px;
        }

        .signatures {
            margin-top: 12px;
        }

        .signatures-table {
            width: 100%;
            border-collapse: collapse;
        }

        .signatures-table td {
            text-align: center;
            vertical-align: top;
            width: 33.33%;
            padding: 0 5px;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            height: 15px;
            margin-bottom: 2px;
        }

        .signature-label {
            font-size: 6px;
            font-weight: bold;
        }

        .signature-name {
            font-size: 6px;
            margin-top: 2px;
        }

        .student-info {
            background-color: #f5f5f5;
            padding: 5px;
            border: 1px solid #ccc;
            margin-bottom: 8px;
        }

        .info-row {
            display: flex;
            margin-bottom: 2px;
            font-size: 7px;
        }

        .info-label {
            font-weight: bold;
            width: 60px;
        }

        .footer-info {
            margin-top: 8px;
            font-size: 5px;
            color: #666;
            text-align: center;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .report-copy {
                height: 50%;
            }
        }
    </style>
</head>

<body>
    <!-- Primera copia -->
    <div class="report-copy">
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
                <span class="form-label" style="margin-left: 8px;">de</span>
                <span class="form-field" style="margin-left: 5px;">{{ $reporte->fecha_reporte->format('F') }}</span>
                <span class="form-label" style="margin-left: 8px;">de 20</span>
                <span class="form-field" style="margin-left: 5px;">{{ $reporte->fecha_reporte->format('y') }}</span>
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
                <span class="form-label">Alumno (a):</span>
                <span class="form-field">{{ $reporte->student->full_name }}</span>
                <span class="form-label" style="margin-left: 8px;">Grado:</span>
                <span class="form-field" style="margin-left: 5px;">{{ $reporte->student->grado }}°
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
            <div class="form-label" style="font-weight: bold; margin-bottom: 3px;">DESCRIPCIÓN DEL REPORTE:</div>
            <div class="description-box">
                {{ $reporte->descripcion_reporte }}
            </div>
        </div>

        <!-- Observaciones si existen -->
        @if ($reporte->observaciones)
            <div class="form-section">
                <div class="form-label" style="font-weight: bold; margin-bottom: 3px;">OBSERVACIONES:</div>
                <div class="description-box" style="min-height: 40px;">
                    {{ $reporte->observaciones }}
                </div>
            </div>
        @endif
        <br> <br>

        <!-- Firmas -->
        <div class="signatures">
            <table class="signatures-table">
                <tr>
                    <td>
                        <div class="signature-line"></div>
                        <div class="signature-name">
                            @if ($reporte->profesor)
                                {{ $reporte->profesor->name }}
                            @endif
                        </div>
                        <div class="signature-label">Profesor (a)</div>
                    </td>
                    <td>
                        <div class="signature-line"></div>
                        <div class="signature-name">
                            @if ($reporte->prefecto)
                                {{ $reporte->prefecto->name }}
                            @endif
                        </div>
                        <div class="signature-label">Prefecto</div>
                        @if ($reporte->firma_prefecto_at)
                            <div style="font-size: 5px; margin-top: 1px;">
                                {{ $reporte->firma_prefecto_at->format('d/m/Y H:i') }}
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="signature-line"></div>
                        <div class="signature-name">
                            @if ($reporte->trabajadorSocial)
                                {{ $reporte->trabajadorSocial->name }}
                            @endif
                        </div>
                        <div class="signature-label">Trabajo Social</div>
                        @if ($reporte->firma_trabajo_social_at)
                            <div style="font-size: 5px; margin-top: 1px;">
                                {{ $reporte->firma_trabajo_social_at->format('d/m/Y H:i') }}</div>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <!-- Información del sistema -->
        <div class="footer-info">
            <div>ID: {{ $reporte->id }} | Ver: {{ $reporte->version }} | Estado:
                {{ ucfirst(str_replace('_', ' ', $reporte->estado)) }} | Generado:
                {{ now()->format('d/m/Y H:i') }}</div>
        </div>
    </div>

    <!-- Segunda copia (duplicado) -->
    <div class="report-copy">
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
                <span class="form-label" style="margin-left: 8px;">de</span>
                <span class="form-field" style="margin-left: 5px;">{{ $reporte->fecha_reporte->format('F') }}</span>
                <span class="form-label" style="margin-left: 8px;">de 20</span>
                <span class="form-field" style="margin-left: 5px;">{{ $reporte->fecha_reporte->format('y') }}</span>
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
                <span class="form-label">Alumno (a):</span>
                <span class="form-field">{{ $reporte->student->full_name }}</span>
                <span class="form-label" style="margin-left: 8px;">Grado:</span>
                <span class="form-field" style="margin-left: 5px;">{{ $reporte->student->grado }}°
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
            <div class="form-label" style="font-weight: bold; margin-bottom: 3px;">DESCRIPCIÓN DEL REPORTE:</div>
            <div class="description-box">
                {{ $reporte->descripcion_reporte }}
            </div>
        </div>

        <!-- Observaciones si existen -->
        @if ($reporte->observaciones)
            <div class="form-section">
                <div class="form-label" style="font-weight: bold; margin-bottom: 3px;">OBSERVACIONES:</div>
                <div class="description-box" style="min-height: 40px;">
                    {{ $reporte->observaciones }}
                </div>
            </div>
        @endif
        <br> <br>
        <!-- Firmas -->
        <div class="signatures">
            <table class="signatures-table">
                <tr>
                    <td>
                        <div class="signature-line"></div>
                        <div class="signature-name">
                            @if ($reporte->profesor)
                                {{ $reporte->profesor->name }}
                            @endif
                        </div>
                        <div class="signature-label">Profesor (a)</div>
                    </td>
                    <td>
                        <div class="signature-line"></div>
                        <div class="signature-name">
                            @if ($reporte->prefecto)
                                {{ $reporte->prefecto->name }}
                            @endif
                        </div>
                        <div class="signature-label">Prefecto</div>
                        @if ($reporte->firma_prefecto_at)
                            <div style="font-size: 5px; margin-top: 1px;">
                                {{ $reporte->firma_prefecto_at->format('d/m/Y H:i') }}
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="signature-line"></div>
                        <div class="signature-name">
                            @if ($reporte->trabajadorSocial)
                                {{ $reporte->trabajadorSocial->name }}
                            @endif
                        </div>
                        <div class="signature-label">Trabajo Social</div>
                        @if ($reporte->firma_trabajo_social_at)
                            <div style="font-size: 5px; margin-top: 1px;">
                                {{ $reporte->firma_trabajo_social_at->format('d/m/Y H:i') }}</div>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <!-- Información del sistema -->
        <div class="footer-info">
            <div>ID: {{ $reporte->id }} | Ver: {{ $reporte->version }} | Estado:
                {{ ucfirst(str_replace('_', ' ', $reporte->estado)) }} | Generado:
                {{ now()->format('d/m/Y H:i') }}</div>
        </div>
    </div>
</body>

</html>
