IF  EXISTS (SELECT * FROM sys.objects WHERE object_id = OBJECT_ID(N'[INV].[tbRegistroDatosCamaronera]') AND type in (N'U'))
DROP TABLE [INV].[tbRegistroDatosCamaronera]
GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [INV].[tbRegistroDatosCamaronera](
	[Camaronera] [varchar](50) NULL,
	[fecha] [date] NULL,
	[Piscina] [varchar](50) NULL,
	[Corrida] [varchar](50) NULL,
	[Alimento] [varchar](50) NULL,
	[Cantidad] [decimal](18, 8) NULL,
	[Alimento2] [varchar](50) NULL,
	[Cantidad2] [decimal](18, 8) NULL,
	[Estado] [varchar](50) NULL,
	[MovimientoId] [int] NULL,
	[SecuenciaId] [int] NULL
) ON [PRIMARY]
GO

camaronera
fecha_entrega
id_piscina
id_corrida
tipo_alimento
cantidad_balanceado
tipo_balanceado

BULK INSERT [INV].[tbRegistroDatosCamaronera]
FROM 'Ruta\archivo.csv'
WITH (
    FIELDTERMINATOR = ',',  -- Delimitador de campos
    ROWTERMINATOR = '\n',    -- Delimitador de filas
    FIRSTROW = 2,            -- Indica que la primera fila es de encabezados
    TABLOCK                -- Opci贸n para mejorar el rendimiento
);

$serverName = "tu_servidor";
$connectionOptions = array(
    "Database" => "t",
    "Uid" => "",
    "PWD" => ""
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "Conexión exitosa.";
}


try {
    $conn = new PDO("odbc:Driver={SQL Server};Server=tu_servidor;Database=tu_base_de_datos", "tu_usuario", "tu_contraseña");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa.";
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
PDO_SQLSRV

