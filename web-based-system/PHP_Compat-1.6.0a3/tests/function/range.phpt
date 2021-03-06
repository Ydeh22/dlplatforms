--TEST--
Function -- range
--FILE--
<?php
require_once 'PHP/Compat/Function/range.php';

$steps = array(1, 2, 3, 3.5, 10, -1, -1.5, 'foo', array(), null);

$tests = array(
    array(1.5, 10.5),
    array(10, 1),
    array(-5, 5),
    array('a', 'd'),
    array('d', 'a'),
    array('A', 'z'),
    array('aa', 'zz'),
    array('aaa', 'zzz'),
    array('00', '99'),
    array('000', '100'),
    array('!', '[')
);

foreach ($steps as $step) {
    foreach ($tests as $test) {
        echo "($test[0], $test[1], $step): \n";
        echo implode('_', range($test[0], $test[1], 2)), "\n\n";
    }
}

?>
--EXPECT--
(1.5, 10.5, 1): 
1.5_3.5_5.5_7.5_9.5

(10, 1, 1): 
10_8_6_4_2

(-5, 5, 1): 
-5_-3_-1_1_3_5

(a, d, 1): 
a_c

(d, a, 1): 
d_b

(A, z, 1): 
A_C_E_G_I_K_M_O_Q_S_U_W_Y_[_]___a_c_e_g_i_k_m_o_q_s_u_w_y

(aa, zz, 1): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(aaa, zzz, 1): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(00, 99, 1): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98

(000, 100, 1): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98_100

(!, [, 1): 
!_#_%_'_)_+_-_/_1_3_5_7_9_;_=_?_A_C_E_G_I_K_M_O_Q_S_U_W_Y_[

(1.5, 10.5, 2): 
1.5_3.5_5.5_7.5_9.5

(10, 1, 2): 
10_8_6_4_2

(-5, 5, 2): 
-5_-3_-1_1_3_5

(a, d, 2): 
a_c

(d, a, 2): 
d_b

(A, z, 2): 
A_C_E_G_I_K_M_O_Q_S_U_W_Y_[_]___a_c_e_g_i_k_m_o_q_s_u_w_y

(aa, zz, 2): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(aaa, zzz, 2): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(00, 99, 2): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98

(000, 100, 2): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98_100

(!, [, 2): 
!_#_%_'_)_+_-_/_1_3_5_7_9_;_=_?_A_C_E_G_I_K_M_O_Q_S_U_W_Y_[

(1.5, 10.5, 3): 
1.5_3.5_5.5_7.5_9.5

(10, 1, 3): 
10_8_6_4_2

(-5, 5, 3): 
-5_-3_-1_1_3_5

(a, d, 3): 
a_c

(d, a, 3): 
d_b

(A, z, 3): 
A_C_E_G_I_K_M_O_Q_S_U_W_Y_[_]___a_c_e_g_i_k_m_o_q_s_u_w_y

(aa, zz, 3): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(aaa, zzz, 3): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(00, 99, 3): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98

(000, 100, 3): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98_100

(!, [, 3): 
!_#_%_'_)_+_-_/_1_3_5_7_9_;_=_?_A_C_E_G_I_K_M_O_Q_S_U_W_Y_[

(1.5, 10.5, 3.5): 
1.5_3.5_5.5_7.5_9.5

(10, 1, 3.5): 
10_8_6_4_2

(-5, 5, 3.5): 
-5_-3_-1_1_3_5

(a, d, 3.5): 
a_c

(d, a, 3.5): 
d_b

(A, z, 3.5): 
A_C_E_G_I_K_M_O_Q_S_U_W_Y_[_]___a_c_e_g_i_k_m_o_q_s_u_w_y

(aa, zz, 3.5): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(aaa, zzz, 3.5): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(00, 99, 3.5): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98

(000, 100, 3.5): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98_100

(!, [, 3.5): 
!_#_%_'_)_+_-_/_1_3_5_7_9_;_=_?_A_C_E_G_I_K_M_O_Q_S_U_W_Y_[

(1.5, 10.5, 10): 
1.5_3.5_5.5_7.5_9.5

(10, 1, 10): 
10_8_6_4_2

(-5, 5, 10): 
-5_-3_-1_1_3_5

(a, d, 10): 
a_c

(d, a, 10): 
d_b

(A, z, 10): 
A_C_E_G_I_K_M_O_Q_S_U_W_Y_[_]___a_c_e_g_i_k_m_o_q_s_u_w_y

(aa, zz, 10): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(aaa, zzz, 10): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(00, 99, 10): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98

(000, 100, 10): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98_100

(!, [, 10): 
!_#_%_'_)_+_-_/_1_3_5_7_9_;_=_?_A_C_E_G_I_K_M_O_Q_S_U_W_Y_[

(1.5, 10.5, -1): 
1.5_3.5_5.5_7.5_9.5

(10, 1, -1): 
10_8_6_4_2

(-5, 5, -1): 
-5_-3_-1_1_3_5

(a, d, -1): 
a_c

(d, a, -1): 
d_b

(A, z, -1): 
A_C_E_G_I_K_M_O_Q_S_U_W_Y_[_]___a_c_e_g_i_k_m_o_q_s_u_w_y

(aa, zz, -1): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(aaa, zzz, -1): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(00, 99, -1): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98

(000, 100, -1): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98_100

(!, [, -1): 
!_#_%_'_)_+_-_/_1_3_5_7_9_;_=_?_A_C_E_G_I_K_M_O_Q_S_U_W_Y_[

(1.5, 10.5, -1.5): 
1.5_3.5_5.5_7.5_9.5

(10, 1, -1.5): 
10_8_6_4_2

(-5, 5, -1.5): 
-5_-3_-1_1_3_5

(a, d, -1.5): 
a_c

(d, a, -1.5): 
d_b

(A, z, -1.5): 
A_C_E_G_I_K_M_O_Q_S_U_W_Y_[_]___a_c_e_g_i_k_m_o_q_s_u_w_y

(aa, zz, -1.5): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(aaa, zzz, -1.5): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(00, 99, -1.5): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98

(000, 100, -1.5): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98_100

(!, [, -1.5): 
!_#_%_'_)_+_-_/_1_3_5_7_9_;_=_?_A_C_E_G_I_K_M_O_Q_S_U_W_Y_[

(1.5, 10.5, foo): 
1.5_3.5_5.5_7.5_9.5

(10, 1, foo): 
10_8_6_4_2

(-5, 5, foo): 
-5_-3_-1_1_3_5

(a, d, foo): 
a_c

(d, a, foo): 
d_b

(A, z, foo): 
A_C_E_G_I_K_M_O_Q_S_U_W_Y_[_]___a_c_e_g_i_k_m_o_q_s_u_w_y

(aa, zz, foo): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(aaa, zzz, foo): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(00, 99, foo): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98

(000, 100, foo): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98_100

(!, [, foo): 
!_#_%_'_)_+_-_/_1_3_5_7_9_;_=_?_A_C_E_G_I_K_M_O_Q_S_U_W_Y_[

(1.5, 10.5, Array): 
1.5_3.5_5.5_7.5_9.5

(10, 1, Array): 
10_8_6_4_2

(-5, 5, Array): 
-5_-3_-1_1_3_5

(a, d, Array): 
a_c

(d, a, Array): 
d_b

(A, z, Array): 
A_C_E_G_I_K_M_O_Q_S_U_W_Y_[_]___a_c_e_g_i_k_m_o_q_s_u_w_y

(aa, zz, Array): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(aaa, zzz, Array): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(00, 99, Array): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98

(000, 100, Array): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98_100

(!, [, Array): 
!_#_%_'_)_+_-_/_1_3_5_7_9_;_=_?_A_C_E_G_I_K_M_O_Q_S_U_W_Y_[

(1.5, 10.5, ): 
1.5_3.5_5.5_7.5_9.5

(10, 1, ): 
10_8_6_4_2

(-5, 5, ): 
-5_-3_-1_1_3_5

(a, d, ): 
a_c

(d, a, ): 
d_b

(A, z, ): 
A_C_E_G_I_K_M_O_Q_S_U_W_Y_[_]___a_c_e_g_i_k_m_o_q_s_u_w_y

(aa, zz, ): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(aaa, zzz, ): 
a_c_e_g_i_k_m_o_q_s_u_w_y

(00, 99, ): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98

(000, 100, ): 
0_2_4_6_8_10_12_14_16_18_20_22_24_26_28_30_32_34_36_38_40_42_44_46_48_50_52_54_56_58_60_62_64_66_68_70_72_74_76_78_80_82_84_86_88_90_92_94_96_98_100

(!, [, ): 
!_#_%_'_)_+_-_/_1_3_5_7_9_;_=_?_A_C_E_G_I_K_M_O_Q_S_U_W_Y_[

