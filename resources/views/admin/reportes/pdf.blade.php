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
            font-size: 12px;
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

        .header-table {
            width: 100%;
            margin-bottom: 8px;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: middle;
            text-align: center;
            padding: 5px;
        }

        .header-logo-cell {
            width: 20%;
        }

        .header-content-cell {
            width: 60%;
        }

        .header-logos {
            width: 60px;
            height: 60px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-logos img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .school-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .school-address {
            font-size: 15px;
            margin-bottom: 2px;
        }

        .report-title {
            font-size: 18px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 8px;
        }

        .form-section {
            margin-bottom: 8px;
        }

        .form-section.text-right {
            text-align: right;
        }

        .form-section.text-right .form-row {
            justify-content: flex-end;
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

        .bold-underline {
            font-weight: bold;
            text-decoration: underline;
            font-size: 12px;
        }

        .description-box {
            /* border: 1px solid #000; */
            padding: 5px;
            margin-top: 5px;
            font-size: 12px;
            border-radius: 20px;
        }

        .observations-wrapper {
            border: 2px solid #333;
            border-radius: 25px;
            padding: 15px;
            margin: 10px 0;
            background-color: #f9f9f9;
        }

        .observations-wrapper-no-border {
            border-radius: 25px;
            padding: 15px;
            margin: 10px 0;
            background-color: #f9f9f9;
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
            border-radius: 20px;
        }

        .info-row {
            display: flex;
            margin-bottom: 2px;
            font-size: 12px;
        }

        .info-label {
            font-weight: bold;
            width: 60px;
        }

        .footer-info {
            margin-top: 8px;
            font-size: 12px;
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
        <table class="header-table">
            <tr>
                <!-- Logo izquierdo -->
                <td class="header-logo-cell">
                    <div class="header-logos">
                        <img src="{{ public_path('images/logo_seduc.png') }}" alt="Logo SEDUC">
                    </div>
                </td>

                <!-- Contenido central -->
                <td class="header-content-cell">
                    <div class="school-name">Escuela Secundaria Técnica N°1</div>
                    <div class="school-address">Av. Juan de la barrera No. 9 frente Unid. Hab. FOVI</div>
                    <div class="school-address">San Francisco de Campeche, Campeche</div>
                    <div class="report-title">REPORTE DEL ALUMNO</div>
                </td>

                <!-- Logo derecho -->
                <td class="header-logo-cell">
                    <div class="header-logos">
                        <img src="{{ public_path('images/LOGO_TECNICAS_vectorized.png') }}" alt="Logo Técnicas">
                    </div>
                </td>
            </tr>
        </table>
        <hr>

        <div class="form-section text-right">
            <div class="form-row">
                <span class="form-label">FECHA:</span>
                <span class="bold-underline">{{ $reporte->fecha_reporte->format('d') }}</span>
                <span class="form-label" style="margin-left: 14px;">de</span>
                <span class="bold-underline">{{ $reporte->fecha_reporte->locale('es')->monthName }}</span>
                <span class="form-label" style="margin-left: 14px;">de 20</span>
                <span class="bold-underline">{{ $reporte->fecha_reporte->format('Y') }}</span>
            </div>
        </div>

        <div class="observations-wrapper">
            <div class="form-row">
                <span class="form-label" style="margin-left: 14px;">C. Profr. (a):</span>
                <span class="bold-underline">{{ $reporte->profesor->name }}</span>.
                -materia,
                <span class="bold-underline">{{ $reporte->materia }}</span>.
                Manifiesta que el alumno(a),
                <span class="bold-underline">{{ $reporte->student->full_name }}</span>. de
                <span class="bold-underline">{{ $reporte->student->grado }}°</span>, Grupo
                <span class="bold-underline">{{ $reporte->student->grupo }}</span>.
            </div>
        </div>


        <!-- Información adicional del estudiante -->
        <div class="student-info">
            <br>
            <div class="info-row">
                <span class="info-label">DESCRIPCION DEL REPORTE:</span>
                <span class="bold-underline">{{ $reporte->descripcion_reporte }}</span>
            </div>
            <br>
        </div>

        <!-- Observaciones si existen -->
        @if ($reporte->observaciones)
            <div class="observations-wrapper">
                <div class="form-section">
                    <div class="form-label" style="font-weight: bold; margin-bottom: 3px;">OBSERVACIONES:</div>
                    <div class="description-box">
                        {{ $reporte->observaciones }}
                    </div>
                </div>
            </div>
        @endif
        <br>

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
                            <div style="font-size: 5px;">
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
        <table class="header-table">
            <tr>
                <!-- Logo izquierdo -->
                <td class="header-logo-cell">
                    <div class="header-logos">
                        <img src="{{ public_path('images/logo_seduc.png') }}" alt="Logo SEDUC">
                    </div>
                </td>

                <!-- Contenido central -->
                <td class="header-content-cell">
                    <div class="school-name">Escuela Secundaria Técnica N°1</div>
                    <div class="school-address">Av. Juan de la barrera No. 9 frente Unid. Hab. FOVI</div>
                    <div class="school-address">San Francisco de Campeche, Campeche</div>
                    <div class="report-title">REPORTE DEL ALUMNO</div>
                </td>

                <!-- Logo derecho -->
                <td class="header-logo-cell">
                    <div class="header-logos">
                        <img src="{{ public_path('images/LOGO_TECNICAS_vectorized.png') }}" alt="Logo Técnicas">
                    </div>
                </td>
            </tr>
        </table>
        <hr>

        <div class="form-section text-right">
            <div class="form-row">
                <span class="form-label">FECHA:</span>
                <span class="bold-underline">{{ $reporte->fecha_reporte->format('d') }}</span>
                <span class="form-label" style="margin-left: 14px;">de</span>
                <span class="bold-underline">{{ $reporte->fecha_reporte->locale('es')->monthName }}</span>
                <span class="form-label" style="margin-left: 14px;">de 20</span>
                <span class="bold-underline">{{ $reporte->fecha_reporte->format('Y') }}</span>
            </div>
        </div>

        <div class="observations-wrapper">
            <div class="form-row">
                <span class="form-label" style="margin-left: 14px;">C. Profr. (a):</span>
                <span class="bold-underline">{{ $reporte->profesor->name }}</span>.
                -materia,
                <span class="bold-underline">{{ $reporte->materia }}</span>.
                Manifiesta que el alumno(a),
                <span class="bold-underline">{{ $reporte->student->full_name }}</span>. de
                <span class="bold-underline">{{ $reporte->student->grado }}°</span>, Grupo
                <span class="bold-underline">{{ $reporte->student->grupo }}</span>.
            </div>
        </div>


        <!-- Información adicional del estudiante -->
        <div class="student-info">
            <br>
            <div class="info-row">
                <span class="info-label">DESCRIPCION DEL REPORTE:</span>
                <span class="bold-underline">{{ $reporte->descripcion_reporte }}</span>
            </div>
            <br>
        </div>

        <!-- Observaciones si existen -->
        @if ($reporte->observaciones)
            <div class="observations-wrapper">
                <div class="form-section">
                    <div class="form-label" style="font-weight: bold; margin-bottom: 3px;">OBSERVACIONES:</div>
                    <div class="description-box">
                        {{ $reporte->observaciones }}
                    </div>
                </div>
            </div>
        @endif
        <br>

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
                            <div style="font-size: 5px;">
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
