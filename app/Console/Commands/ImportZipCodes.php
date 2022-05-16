<?php

namespace App\Console\Commands;

use App\Models\ZipCode;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ImportZipCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:zipcodes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import zip codes from a TXT file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->info('Incio de importación de códigos postales');

        $filePath = storage_path('zip-codes/CPdescarga.txt');

        $this->info('Archivo: ' . $filePath);

        if (!File::exists($filePath)) {
            $this->error('Archivo no encontrado');
            return 0;
        }

        $contentTxt = new \SplFileObject($filePath);

        $columnNames = [];
        foreach ($contentTxt as $index => $line) {

            if ($index == 0) {
                continue;
            }

            $line = preg_replace('/\n|\r\n/', '', $line);

            if ($index == 1) {
                $columnNames = explode('|', $line);
                continue;
            }

            $zipCodeValues = $this->filterOrSanitizeValues($line);

            if (count($zipCodeValues) != count($columnNames)) {
                $this->error('Error en linea: ' . $line);
                continue;
            }

            $item = array_combine($columnNames, $zipCodeValues);

            try {
                ZipCode::create($item);
                $this->info('Código postal importado: ' . $item['d_codigo']. ' - ' . $item['d_asenta']);
            } catch (\Exception $e) {
                $message = $e->getMessage();
                $this->error($message);
            }
        }
        return 1;
    }

    protected function filterOrSanitizeValues($line): array
    {
        $arr = explode('|', preg_replace('/\r\n/', '', $line));

        $filtered = [];

        foreach ($arr as $key => $value) {
            $filtered[$key] = utf8_encode($value);
        }

        return $filtered;
    }
}
