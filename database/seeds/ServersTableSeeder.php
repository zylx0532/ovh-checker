<?php

use Illuminate\Database\Seeder;

class BaseServer
{
	public function __construct(string $name, string $code, 
		string $spec, float $price)
	{
		$this->name = $name;
		$this->code = $code;
		$this->spec = $spec;
		$this->price = $price;
	}

	public $name;
	public $code;
	public $spec;
	public $price;
}

class ServersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $base_servers = [
        	new BaseServer('KS-1', '1801sk12', 'Atom D425, 2 GB RAM, 500 GB HDD', 3.99),
        	new BaseServer('KS-2', '1801sk13', 'Atom N2800, 4 GB RAM, 1 TB HDD', 4.99),
        	new BaseServer('KS-3', '1801sk14', 'Atom N2800, 4 GB RAM, 2 TB HDD', 7.99),
        	new BaseServer('KS-4', '1801sk15', 'Atom N2800, 4 GB RAM, 2x2 TB HDD', 13.99),
        	new BaseServer('KS-5', '1801sk16', 'AMD Opteron 4122, 16 GB RAM, 2 TB HDD', 13.99),
        	new BaseServer('KS-6', '1801sk17', 'Intel i5-750, 16 GB RAM, 2 TB HDD', 14.99),
        	new BaseServer('KS-7', '1801sk18', 'Intel i3-2130, 8 GB RAM, 2 TB HDD', 14.99),
        	new BaseServer('KS-8', '1801sk19', 'Intel i7-920, 16 GB RAM, 2 TB HDD', 15.99),
        	new BaseServer('KS-9', '1801sk20', 'Intel Xeon W3520, 16 GB RAM, 2x240 GB SSD', 16.99),
        	new BaseServer('KS-10', '1801sk21', 'Intel i5-2300, 16 GB RAM, 2 TB HDD', 18.99),
        	new BaseServer('KS-11', '1801sk22', 'Intel Xeon W3520, 16 GB RAM, 2x2 TB HDD', 19.99),
        	new BaseServer('KS-12', '1801sk23', 'Intel Xeon W3520, 32 GB RAM, 2x2 TB HDD', 24.99)
        ];

        foreach ($base_servers as $s)
        {
        	DB::table('servers')->insert([
        		'name' => $s->name,
        		'code' => $s->code,
        		'spec' => $s->spec,
        		'price' => $s->price,
        		'available' => false,
        		'sbg' => null,
        		'rbx' => null,
        		'gra' => null
        	]);
        }
    }
}
