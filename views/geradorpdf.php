<?php
require("./fpdf/fpdf.php");


// Dados de exemplo
$nome = "EDUARDA CAROLINA DO NASCIMENTO";
$idade = 25;
$data_emissao = date("d/m/Y - H:i");
$sexo = 'Feminino';
$prontuario = "000967696";
$nomesocial = "";
$exame = "TIPAGEM SANGUÍNEA ABO(RH)";
$materialE = "SANGUE TOTAL";
$metodoE = "HEMAGLUTINAÇÃO";
$grupo = 'B';
$fator = 'POSITIVO';
$LiberadoPor = "EDUARDA CAROLINA DO NASCIMENTO";
$CRF =38691;
$laboratorio ='LABORATÓRIO DE ENSINO DE ANÁLISES CLÍNICAS. ';
$laboratorioLocalizacao =' UNIVERSIDADE POSITIVO. RUA: JOÃO ROGÉRIO RIBEIRO BONESI,
150 - LONDRINA/ PR. CEP: 86047-625.';

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

// simbolo da instituição
$pdf->Image('./imgems/logotipo.png', 13, 12, 50); // (x=10, y=10, largura=30mm)
$pdf->Ln(10); // Espaço

#linha de separacão
$pdf->SetDrawColor(35, 76, 127);
$pdf->SetLineWidth(1.2);
$pdf->Line(12, 28.5, 200, 28.5); // Linha azul abaixo do título

//mudansa de tamnho de letra 
$pdf->SetFont('Arial','B',10);
//nome
$pdf->SetXY(11,28);
$pdf->Cell(0, 10, 'PACIENTE: ' . strtoupper($nome), 0, 1, 'L');//utf8_decode para suportar utf8,strtoupper deixa maiuscolas

//idade
$pdf->SetFont('Arial','',10);
$pdf->SetXY(11,32);
$pdf->Cell(10, 10, 'Idade: ' . $idade . ' anos', 0, 1, 'L');

//sexo
$pdf->SetXY(11,36.5);
$pdf->Cell(10, 10, 'Sexo.: ' . $sexo, 0, 1, 'L');

//prontuario
$pdf->SetXY(11,41);
$pdf->Cell(10, 10, 'Prontuario: ' . $prontuario, 0, 1, 'L');

//data emição
$pdf->SetXY(110,41);
$pdf->Cell(15, 10, 'Data.:' . $data_emissao, 0, 1, 'L');

//nome social
$pdf->SetXY(110,28.2);
$pdf->Cell(15, 10, 'Nome Social: ' . $nomesocial, 0, 1, 'L');

//linha 
$pdf->Line(12, 50, 200, 50); // Linha azul abaixo do título

//nome do exame
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(15,32);
$pdf->write(55, 'EXAME:  ');
$pdf->SetTextColor(53, 100, 151);
$pdf->write(55, utf8_decode(strtoupper($exame)));
//materal
$pdf->SetFont('Courier', 'B', 10);
$pdf->SetTextColor(105,105,105);
$pdf->SetXY(15,65);
$pdf->write(0, utf8_decode(strtoupper('Material: '. $materialE.' / '.'MÉTODO: '.$metodoE)));

//só resultado
$pdf->SetFont('Courier', 'B', 11);
$pdf->SetTextColor(53, 100, 151);
$pdf->SetXY(15,86.5);
$pdf->write(10, strtoupper('Resultado: '));

//grupo sanguineo
$pdf->SetXY(15,100);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Courier', 'B', 12);
$pdf->Cell(0, 10, utf8_decode('GRUPO SANGUÍNEO: ') . str_repeat('.', 30) . ' "' . strtoupper($grupo) . '"', 0, 1);

//fator Rh
$pdf->SetXY(15,107);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Courier', 'B', 12);
$pdf->Cell(0, 10, utf8_decode('FATOR Rh: ') . str_repeat('.', 37) . ' "' . strtoupper($fator) . '"', 0, 1);

//testo de observação
$pdf->SetXY(15,130);
$pdf->SetTextColor(105,105,105);
$pdf->SetFont('Courier', 'B', 10);
$pdf->write(5, utf8_decode('OBS: Este laudo é estritamente destinado a fins acadêmicos e, portanto, não possui
validade legal.'),'');

//liberado por 
$pdf->SetFont('Courier', 'B', 10);
$pdf->SetXY(12,250);
$pdf->SetTextColor(53, 100, 151);
$pdf->write(0, 'Liberado por: '  );
$pdf->SetTextColor(0, 0, 0);
$pdf->write(0, utf8_decode(strtoupper($LiberadoPor.' -CRF:'.$CRF)));//aqui crf
$pdf->SetTextColor(53, 100, 151);
//data emição
$pdf->write(0, ' na data: ' );
$pdf->SetTextColor(0, 0, 0);
$pdf->write(0,$data_emissao );

//linha
$pdf->SetLineWidth(2);
$pdf->Line(12, 253, 190, 253);

//roda pé
$pdf->SetXY(15,260);
$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(0,0,0);
$pdf->write(5,utf8_decode('LEAC - LABORATÓRIO DE ENSINO DE ANÁLISES CLÍNICAS. UNIVERSIDADE POSITIVO. RUA: JOÃO ROGÉRIO RIBEIRO BONESI,
150 - LONDRINA/ PR. CEP: 86047-625.'));//laboratorio


$pdf->Output();
?>