<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

/**
 * Seeds database with shop data.
 */
class LaravelShopSeeder extends Seeder
{

  /**
   * Run the database seeds.
   *
   * @return  void
   */
  public function run()
  {

    DB::table('order_status')->delete();

    DB::table('order_status')->insert([
		[
			'code' 				=> 'in_creation',
			'name' 				=> 'In creation',
			'description'       => '订单创建成功',
		],
		[
			'code' 				=> 'pending',
			'name' 				=> 'Pending',
			'description'       => '顾客尚未付款',
		],
		[
			'code' 				=> 'canceled',
			'name' 				=> 'Canceled',
			'description'       => '顾客取消订单',
		],
		[
			'code' 				=> 'expired',
			'name' 				=> 'Expired',
			'description'       => '订单已过期',
		],
		[
			'code' 				=> 'payed',
			'name' 				=> 'Payed',
			'description'       => '顾客订单已付款',
		],
		[
			'code' 				=> 'accepted',
			'name' 				=> 'Accepted',
			'description'       => '律师已接单',
		],
		[
			'code' 				=> 'rejected',
			'name' 				=> 'Rejected',
			'description'       => '律师已拒单',
		],
		[
			'code' 				=> 'in_process',
			'name' 				=> 'In process',
			'description'       => '一方已签到',
		],
		[
			'code' 				=> 'completed',
			'name' 				=> 'Completed',
			'description'       => '订单已完成',
		],
		[
			'code' 				=> 'failed',
			'name' 				=> 'Failed',
			'description'       => 'Failed order. Payment or other process failed.',
		],
		[
			'code' 				=> 'abandoned',
			'name' 				=> 'Abandoned',
			'description'       => '废弃的订单',
		]
	]);
  }
}