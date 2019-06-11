<?php

namespace App\Models; 


use App\Models\Person;
use App\Models\Job;
use App\Models\GroupPerson;
use App\Models\Group;
use App\Models\JobTrainning;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Cache;

class Reports extends Model
{
    public static $spreadsheet;
    public static  $sheet;

    
    public static function getReport($id){ 
        
        $i=6;
        $index=0;
        /**
         * Abre o arquivo arquivo planilhao 
         */
        $inputFileName = './planilhao.xlsx';
        self::$spreadsheet = IOFactory::load($inputFileName);
        self::$spreadsheet->setActiveSheetIndex(0);
        self::$sheet = self::$spreadsheet->getActiveSheet(); 
        /**
         * Limpa planilha
         */
        Reports::clear($i, $index);
        /**
         * verifica os grupos que pertencem aquela Construção
         */
        
        $contruction_id=$id;
        $group=Group::where('construction_id', $id)->orderBy('process_id', 'asc')->get();
        // dd($group);
        foreach($group as $g){
            
            $group_person=GroupPerson::where('group_id', $g->id)->get();

            foreach($group_person as $gp){
                
                if(!Cache::get($gp->person_id)){
                    
                    Reports::setName($i, $index,$gp->person_id,$g->process_id,$gp->status_id, $gp->created_at );

                    $i++;
                }else{
                    
                    Reports::setName($i, $index,$gp->person_id,$g->process_id,$gp->status_id, $gp->created_at );
                    if($g->process_id==4){
                        
                        Reports::setExams($g->creation_date, $gp->person_id, $i, $index );
                    }
                    
                }
            }
        }
        $writer = IOFactory::createWriter(self::$spreadsheet,'Xlsx');
        $writer->save('planilhao.xlsx');
        // dd($writer); 
        Cache::flush();
        $file_content = true;
       return $file_content;
       
    }// end function
    /**
     * Função que cadastra informações pessoais
     */
    public static  function setName($i, $index,$person_id, $process_id, $status_id, $data_ex){
        
        if(!Cache::get($person_id)){
            
            Cache::forever($person_id, 'ok');
            $person= Person::orderBy('name', 'asc')->where('id', $person_id)->get();
            
            foreach($person as $p){
                $p=json_decode($p);
                
                if($p->job_id!="" || $p->job_id!=null ){
                    $job=Job::find($p->job_id);
                    $job=json_decode($job);
                    self::$sheet->setCellValue('E'.$i, $job->name); 
                }
                if($process_id==1){
                    if($status_id==1){
                        self::$sheet->setCellValue('S'.$i, "Aprovado"); 
                    }
                    else if($status_id==2){
                        self::$sheet->setCellValue('S'.$i, "Inapto"); 
                    }
                    else if($status_id==3){
                        self::$sheet->setCellValue('S'.$i, "Aprovado com Ressalva");
                    }
                    else{
                        self::$sheet->setCellValue('S'.$i, "Indefinido");
                    }
                }else if($process_id==2){
                    if($status_id==1){
                        self::$sheet->setCellValue('V'.$i, "Aprovado"); 
                    }
                    else if($status_id==2){
                        self::$sheet->setCellValue('V'.$i, "Inapto"); 
                    }
                    else if($status_id==3){
                        self::$sheet->setCellValue('V'.$i, "Aprovado com Ressalva");
                    }
                    else{
                        self::$sheet->setCellValue('V'.$i, "Indefinido");
                    }
                }
                self::$sheet->setCellValue('D'.$i, $p->name); 
                self::$sheet->setCellValue('F'.$i, $p->motherName);
                self::$sheet->setCellValue('G'.$i, $p->rg);
                self::$sheet->setCellValue('H'.$i, $p->cpf);
                self::$sheet->setCellValue('I'.$i, $p->birthDate);
                self::$sheet->setCellValue('J'.$i, $p->neighborhood);
                self::$sheet->setCellValue('K'.$i, $p->city);
                self::$sheet->setCellValue('L'.$i, $p->states);
                self::$sheet->setCellValue('M'.$i, $p->phoneMobile);
                self::$sheet->setCellValue('N'.$i, $p->mobileAlternative);
                $i++;
            }
        }
        else{
            
            $person= Person::orderBy('name', 'asc')->where('id', $person_id)->get();
            foreach($person as $p){
                
                $i=6;
                $error=false;
                
                while(self::$sheet->getCell('D'.$i)!=$p->name){
                    $i++;
                    if($i==100){
                        $error=true;
                        break;
                    }
                    else{
                        $error=false;
                    }
                }
                if(!$error){
                    //Técnica
                    if($process_id==1){
                        if($status_id==1){
                            self::$sheet->setCellValue('S'.$i, "Aprovado"); 
                        }
                        else if($status_id==2){
                            self::$sheet->setCellValue('S'.$i, "Inapto"); 
                        }
                        else if($status_id==3){
                            self::$sheet->setCellValue('S'.$i, "Aprovado com Ressalva");
                        }
                        else{
                            self::$sheet->setCellValue('S'.$i, "Indefinido");
                        }
                    }
                    // Psicossocial
                    else if($process_id==2){
                        
                        if($status_id==1){
                            self::$sheet->setCellValue('V'.$i, "Aprovado"); 
                        }
                        else if($status_id==2){
                            self::$sheet->setCellValue('V'.$i, "Inapto"); 
                        }
                        else if($status_id==3){
                            self::$sheet->setCellValue('V'.$i, "Aprovado com Ressalva");
                        }
                        else{
                            self::$sheet->setCellValue('V'.$i, "Indefinido");
                        }
                       
                    }
                    // Treinamentos
                    else if($process_id==3){
                        Reports::setTraining($p->job_id, $i, $index); 
                    }
                    // Crachá
                    else if($process_id==5){
                        die('5');
                    }//end else if
                }// end if !error
            }//end foreach
        }//end else
    }//end function
    /**
     * Função de Limpeza de planilha
     */
    public static function clear($i, $index){
        $inputFileName = './planilhao.xlsx';
        do 
        {
            self::$sheet->setCellValue('D'.$i, "");
            self::$sheet->setCellValue('E'.$i, "");
            self::$sheet->setCellValue('F'.$i, "");
            self::$sheet->setCellValue('G'.$i, "");
            self::$sheet->setCellValue('H'.$i, "");
            self::$sheet->setCellValue('I'.$i, "");
            self::$sheet->setCellValue('J'.$i, "");
            self::$sheet->setCellValue('K'.$i, "");
            self::$sheet->setCellValue('L'.$i, "");
            self::$sheet->setCellValue('M'.$i, "");
            self::$sheet->setCellValue('N'.$i, ""); 
            $i++;
        }while(self::$sheet->getCell('D'.$i)!="");
    }//end function

    /**
     * Função para cadastrar os trainamentos
     */
    public static function setTraining($job_id, $i, $index){
        $training=JobTraining::where('job_id', $job_id)->get();
        foreach($training as $t){
            $t=json_decode($t);
            //NR 10
            if($t->id==2 || $t->id==4 ){
                self::$sheet->setCellValue('AO'.$i, $t->created_at);  
            }
            //NR 20
            else if($t->id==6 || $t->id==8 || $t->id==10 || $t->id==16|| $t->id==22){
                self::$sheet->setCellValue('AL'.$i, $t->created_at);  
            }
            //NR 33
            else if($t->id==1 || $t->id==3 || $t->id==19){
                self::$sheet->setCellValue('AI'.$i, $t->created_at);  
            }
            //NR 34
            else if($t->id==11 || $t->id==23 || $t->id==10 || $t->id==16|| $t->id==22){
                self::$sheet->setCellValue('AJ'.$i, $t->created_at);  
            }
            //NR 35
            else if($t->id==5|| $t->id==17 || $t->id==18){
                self::$sheet->setCellValue('AK'.$i, $t->created_at);  
            }
            // Integração petrobras
            else if($t->id==20){
                self::$sheet->setCellValue('AF'.$i, $t->created_at);  
            }
            // Salvatagem
            else if($t->id==21){
                self::$sheet->setCellValue('AP'.$i, $t->created_at);  
            }
            // PPR Integração
            else if($t->id==14){
                self::$sheet->setCellValue('AG'.$i, $t->created_at);  
            }
            // PCA Integração
            else if($t->id==15){
                self::$sheet->setCellValue('AH'.$i, $t->created_at);  
            }
            // DSS 
            else if($t->id==13){
                self::$sheet->setCellValue('AN'.$i, $t->created_at);  
            }
            // DDSMS
            else if($t->id==15){
                self::$sheet->setCellValue('AM'.$i, $t->created_at);  
            }
            //CURSO DE FORMAÇÃO DE OPERAÇÃO DE PONTE ROLANTE
            else if($t->id==9){
                self::$sheet->setCellValue('AQ'.$i, $t->created_at);  
            }
            // INTEGRAÇÃO ESTRUTURAL
            else if($t->id==7){
                self::$sheet->setCellValue('AR'.$i, $t->created_at);  
            }
        }
    }//end function
    /**
     * Função de cadastros dos Exames
     */
    public static function setExams($data_ex, $person_id, $i, $index ){
        $person= Person::orderBy('name', 'asc')->where('id', $person_id)->get();
        foreach($person as $p){  
            $i=6;
            $error=false;
            while(self::$sheet->getCell('D'.$i)!=$p->name){
                $i++;
                if($i==100){
                    $error=true;
                    break;
                }
                else{
                    $error=false;
                }
            }
            if(!$error){
                self::$sheet->setCellValue('W'.$i, $data_ex);  
            }
        }
    }//end Function
}//end class