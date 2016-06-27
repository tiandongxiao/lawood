<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        # 设置根节点，便于后续操作
        $root = new Category();
        $root->name = "root";
        $root->save();

        # 民商类咨询
        $ms = new Category();
        $ms->name = "民商类";
        $ms->parent_id = $root->id;
        $ms->tab_name = 'ms';
        $ms->save();

        # 刑事类咨询
        $xs = new Category();
        $xs->name = "刑事类";
        $xs->parent_id = $root->id;
        $xs->tab_name = 'xs';
        $xs->save();

        # 行政类咨询
        $xz = new Category();
        $xz->name = "行政类";
        $xz->parent_id = $root->id;
        $xz->tab_name = 'xz';
        $xz->save();

        # 民商类子分类项目
        $ms_hy = new Category();
        $ms_hy->name = "婚姻家庭";
        $ms_hy->parent_id = $ms->id;
        $ms_hy->ratio = 0.2;
        $ms_hy->save();

        $ms_fc = new Category();
        $ms_fc->name = "房产";
        $ms_fc->parent_id = $ms->id;
        $ms_fc->ratio = 0.2;
        $ms_fc->save();

        $ms_zw = new Category();
        $ms_zw->name = "债务";
        $ms_zw->parent_id = $ms->id;
        $ms_zw->ratio = 0.2;
        $ms_zw->save();

        $ms_ld = new Category();
        $ms_ld->name = "劳动争议";
        $ms_ld->parent_id = $ms->id;
        $ms_ld->ratio = 0.2;
        $ms_ld->save();

        $ms_ht = new Category();
        $ms_ht->name = "合同纠纷";
        $ms_ht->parent_id = $ms->id;
        $ms_ht->ratio = 0.2;
        $ms_ht->save();

        $ms_pc = new Category();
        $ms_pc->name = "损害赔偿";
        $ms_pc->parent_id = $ms->id;
        $ms_pc->ratio = 0.2;
        $ms_pc->save();

        $ms_yl = new Category();
        $ms_yl->name = "医疗纠纷";
        $ms_yl->parent_id = $ms->id;
        $ms_yl->ratio = 0.2;
        $ms_yl->save();

        $ms_js = new Category();
        $ms_js->name = "建设工程";
        $ms_js->parent_id = $ms->id;
        $ms_js->ratio = 0.2;
        $ms_js->save();

        $ms_zz = new Category();
        $ms_zz->name = "著作权";
        $ms_zz->parent_id = $ms->id;
        $ms_zz->ratio = 0.2;
        $ms_zz->save();

        $ms_sb = new Category();
        $ms_sb->name = "商标权";
        $ms_sb->parent_id = $ms->id;
        $ms_sb->ratio = 0.2;
        $ms_sb->save();

        $ms_zl = new Category();
        $ms_zl->name = "专利权";
        $ms_zl->parent_id = $ms->id;
        $ms_zl->ratio = 0.2;
        $ms_zl->save();

        $ms_td = new Category();
        $ms_td->name = "土地";
        $ms_td->parent_id = $ms->id;
        $ms_td->ratio = 0.2;
        $ms_td->save();

        $ms_gq = new Category();
        $ms_gq->name = "股权";
        $ms_gq->parent_id = $ms->id;
        $ms_gq->ratio = 0.2;
        $ms_gq->save();


        #刑事类子分类项目
        $xs_bh = new Category();
        $xs_bh->name = "刑事辩护";
        $xs_bh->parent_id = $xs->id;
        $xs_bh->ratio = 0.2;
        $xs_bh->save();

        #行政类子分类项目
        $xz_fy = new Category();
        $xz_fy->name = "行政复议";
        $xz_fy->parent_id = $xz->id;
        $xz_fy->ratio = 0.2;
        $xz_fy->save();

        $xz_ss = new Category();
        $xz_ss->name = "行政诉讼";
        $xz_ss->parent_id = $xz->id;
        $xz_ss->ratio = 0.2;
        $xz_ss->save();

        # 特色服务类
        $spark= new Category();
        $spark->name = "特色服务";
        $spark->parent_id = $root->id;
        $spark->tab_name = 'spark';
        $spark->save();

        # 特色服务子分类项目
        $spark_fcpg = new Category();
        $spark_fcpg->name = "房产陪购";
        $spark_fcpg->parent_id = $spark->id;
        $spark_fcpg->ratio = 0.3;
        $spark_fcpg->save();
    }
}
