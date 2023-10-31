PGDMP                  
    {            food_now_db    16.0    16.0 K               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    16409    food_now_db    DATABASE     �   CREATE DATABASE food_now_db WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_United States.1251';
    DROP DATABASE food_now_db;
                postgres    false            �            1255    16516 !   temp_import_view_insert_trigger()    FUNCTION     _  CREATE FUNCTION public.temp_import_view_insert_trigger() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    INSERT INTO temp_import_table (name, image_path, description, price, region, created_at, updated_at)
    VALUES (NEW.name, NEW.image_path, NEW.description, NEW.price, NEW.region, NEW.created_at, NEW.updated_at);
    RETURN NEW;
END;
$$;
 8   DROP FUNCTION public.temp_import_view_insert_trigger();
       public          postgres    false            �            1259    16527    favourite_restaurants    TABLE     �   CREATE UNLOGGED TABLE public.favourite_restaurants (
    id_favourite_restaurants integer NOT NULL,
    id_restaurant integer NOT NULL,
    id_user integer NOT NULL
);
 )   DROP TABLE public.favourite_restaurants;
       public         heap    postgres    false            �            1259    16526 2   favourite_restaurants_id_favourite_restaurants_seq    SEQUENCE     �   CREATE UNLOGGED SEQUENCE public.favourite_restaurants_id_favourite_restaurants_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 I   DROP SEQUENCE public.favourite_restaurants_id_favourite_restaurants_seq;
       public          postgres    false    224                       0    0 2   favourite_restaurants_id_favourite_restaurants_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.favourite_restaurants_id_favourite_restaurants_seq OWNED BY public.favourite_restaurants.id_favourite_restaurants;
          public          postgres    false    223            �            1259    16537    menu    TABLE     �   CREATE UNLOGGED TABLE public.menu (
    id_food integer NOT NULL,
    name character varying(55),
    weight character varying(55),
    price character varying(50),
    id_restaurant integer NOT NULL
);
    DROP TABLE public.menu;
       public         heap    postgres    false            �            1259    16536    foods_restaurant_id_food_seq    SEQUENCE     �   CREATE UNLOGGED SEQUENCE public.foods_restaurant_id_food_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.foods_restaurant_id_food_seq;
       public          postgres    false    226                       0    0    foods_restaurant_id_food_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.foods_restaurant_id_food_seq OWNED BY public.menu.id_food;
          public          postgres    false    225            �            1259    16443 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false            �            1259    16442    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    218                       0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    217            �            1259    16450    personal_access_tokens    TABLE     �  CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 *   DROP TABLE public.personal_access_tokens;
       public         heap    postgres    false            �            1259    16449    personal_access_tokens_id_seq    SEQUENCE     �   CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.personal_access_tokens_id_seq;
       public          postgres    false    220                       0    0    personal_access_tokens_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;
          public          postgres    false    219            �            1259    16556    regions    TABLE     i   CREATE UNLOGGED TABLE public.regions (
    id_region integer NOT NULL,
    city character varying(75)
);
    DROP TABLE public.regions;
       public         heap    postgres    false            �            1259    16546    restaurants    TABLE     �   CREATE UNLOGGED TABLE public.restaurants (
    id integer NOT NULL,
    name character varying(65),
    image_path character varying(255),
    description text,
    price character varying(50),
    region character varying(45)
);
    DROP TABLE public.restaurants;
       public         heap    postgres    false            �            1259    16545 !   restaurant_list_id_restaurant_seq    SEQUENCE     �   CREATE UNLOGGED SEQUENCE public.restaurant_list_id_restaurant_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 8   DROP SEQUENCE public.restaurant_list_id_restaurant_seq;
       public          postgres    false    228                       0    0 !   restaurant_list_id_restaurant_seq    SEQUENCE OWNED BY     X   ALTER SEQUENCE public.restaurant_list_id_restaurant_seq OWNED BY public.restaurants.id;
          public          postgres    false    227            �            1259    16555 ,   restaurant_regions_id_restaurant_regions_seq    SEQUENCE     �   CREATE UNLOGGED SEQUENCE public.restaurant_regions_id_restaurant_regions_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 C   DROP SEQUENCE public.restaurant_regions_id_restaurant_regions_seq;
       public          postgres    false    230                       0    0 ,   restaurant_regions_id_restaurant_regions_seq    SEQUENCE OWNED BY     f   ALTER SEQUENCE public.restaurant_regions_id_restaurant_regions_seq OWNED BY public.regions.id_region;
          public          postgres    false    229            �            1259    16589    reviews    TABLE     P  CREATE TABLE public.reviews (
    id_review integer NOT NULL,
    username character varying(45) NOT NULL,
    stars smallint NOT NULL,
    review_description text NOT NULL,
    id_restaurant integer NOT NULL,
    id_user integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.reviews;
       public         heap    postgres    false            �            1259    16588    reviews_id_review_seq    SEQUENCE     �   CREATE SEQUENCE public.reviews_id_review_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.reviews_id_review_seq;
       public          postgres    false    234                       0    0    reviews_id_review_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.reviews_id_review_seq OWNED BY public.reviews.id_review;
          public          postgres    false    233            �            1259    16576    shopping_cart    TABLE     �   CREATE UNLOGGED TABLE public.shopping_cart (
    id_shopping_cart integer NOT NULL,
    product_name character varying(65),
    product_weight character varying(45),
    product_price character varying(55),
    product_quantity integer
);
 !   DROP TABLE public.shopping_cart;
       public         heap    postgres    false            �            1259    16575 "   shopping_cart_id_shopping_cart_seq    SEQUENCE     �   CREATE UNLOGGED SEQUENCE public.shopping_cart_id_shopping_cart_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.shopping_cart_id_shopping_cart_seq;
       public          postgres    false    232                       0    0 "   shopping_cart_id_shopping_cart_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.shopping_cart_id_shopping_cart_seq OWNED BY public.shopping_cart.id_shopping_cart;
          public          postgres    false    231            �            1259    16463    users    TABLE     :  CREATE TABLE public.users (
    id integer NOT NULL,
    username character varying(55) NOT NULL,
    email character varying(75) NOT NULL,
    password character varying(255) NOT NULL,
    role character varying(25),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    16462    users_id_seq    SEQUENCE     �   CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    222                       0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    221            H           2604    16530 .   favourite_restaurants id_favourite_restaurants    DEFAULT     �   ALTER TABLE ONLY public.favourite_restaurants ALTER COLUMN id_favourite_restaurants SET DEFAULT nextval('public.favourite_restaurants_id_favourite_restaurants_seq'::regclass);
 ]   ALTER TABLE public.favourite_restaurants ALTER COLUMN id_favourite_restaurants DROP DEFAULT;
       public          postgres    false    224    223    224            I           2604    16540    menu id_food    DEFAULT     x   ALTER TABLE ONLY public.menu ALTER COLUMN id_food SET DEFAULT nextval('public.foods_restaurant_id_food_seq'::regclass);
 ;   ALTER TABLE public.menu ALTER COLUMN id_food DROP DEFAULT;
       public          postgres    false    225    226    226            E           2604    16446    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    217    218    218            F           2604    16453    personal_access_tokens id    DEFAULT     �   ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);
 H   ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    220    219    220            K           2604    16559    regions id_region    DEFAULT     �   ALTER TABLE ONLY public.regions ALTER COLUMN id_region SET DEFAULT nextval('public.restaurant_regions_id_restaurant_regions_seq'::regclass);
 @   ALTER TABLE public.regions ALTER COLUMN id_region DROP DEFAULT;
       public          postgres    false    229    230    230            J           2604    16549    restaurants id    DEFAULT        ALTER TABLE ONLY public.restaurants ALTER COLUMN id SET DEFAULT nextval('public.restaurant_list_id_restaurant_seq'::regclass);
 =   ALTER TABLE public.restaurants ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    228    227    228            M           2604    16592    reviews id_review    DEFAULT     v   ALTER TABLE ONLY public.reviews ALTER COLUMN id_review SET DEFAULT nextval('public.reviews_id_review_seq'::regclass);
 @   ALTER TABLE public.reviews ALTER COLUMN id_review DROP DEFAULT;
       public          postgres    false    234    233    234            L           2604    16579    shopping_cart id_shopping_cart    DEFAULT     �   ALTER TABLE ONLY public.shopping_cart ALTER COLUMN id_shopping_cart SET DEFAULT nextval('public.shopping_cart_id_shopping_cart_seq'::regclass);
 M   ALTER TABLE public.shopping_cart ALTER COLUMN id_shopping_cart DROP DEFAULT;
       public          postgres    false    232    231    232            G           2604    16466    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    222    221    222                       0    16527    favourite_restaurants 
   TABLE DATA           a   COPY public.favourite_restaurants (id_favourite_restaurants, id_restaurant, id_user) FROM stdin;
    public          postgres    false    224   �[                 0    16537    menu 
   TABLE DATA           K   COPY public.menu (id_food, name, weight, price, id_restaurant) FROM stdin;
    public          postgres    false    226   �[       �          0    16443 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public          postgres    false    218   �g       �          0    16450    personal_access_tokens 
   TABLE DATA           �   COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
    public          postgres    false    220   4h                 0    16556    regions 
   TABLE DATA           2   COPY public.regions (id_region, city) FROM stdin;
    public          postgres    false    230   Qh                 0    16546    restaurants 
   TABLE DATA           W   COPY public.restaurants (id, name, image_path, description, price, region) FROM stdin;
    public          postgres    false    228   �i       
          0    16589    reviews 
   TABLE DATA           �   COPY public.reviews (id_review, username, stars, review_description, id_restaurant, id_user, created_at, updated_at) FROM stdin;
    public          postgres    false    234   �}                 0    16576    shopping_cart 
   TABLE DATA           x   COPY public.shopping_cart (id_shopping_cart, product_name, product_weight, product_price, product_quantity) FROM stdin;
    public          postgres    false    232   ~       �          0    16463    users 
   TABLE DATA           \   COPY public.users (id, username, email, password, role, created_at, updated_at) FROM stdin;
    public          postgres    false    222   �~                  0    0 2   favourite_restaurants_id_favourite_restaurants_seq    SEQUENCE SET     c   SELECT pg_catalog.setval('public.favourite_restaurants_id_favourite_restaurants_seq', 234, false);
          public          postgres    false    223                       0    0    foods_restaurant_id_food_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.foods_restaurant_id_food_seq', 217, false);
          public          postgres    false    225                       0    0    migrations_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.migrations_id_seq', 4, true);
          public          postgres    false    217                       0    0    personal_access_tokens_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);
          public          postgres    false    219                       0    0 !   restaurant_list_id_restaurant_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public.restaurant_list_id_restaurant_seq', 58, true);
          public          postgres    false    227                       0    0 ,   restaurant_regions_id_restaurant_regions_seq    SEQUENCE SET     \   SELECT pg_catalog.setval('public.restaurant_regions_id_restaurant_regions_seq', 28, false);
          public          postgres    false    229                        0    0    reviews_id_review_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.reviews_id_review_seq', 1, false);
          public          postgres    false    233            !           0    0 "   shopping_cart_id_shopping_cart_seq    SEQUENCE SET     S   SELECT pg_catalog.setval('public.shopping_cart_id_shopping_cart_seq', 140, false);
          public          postgres    false    231            "           0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 4, true);
          public          postgres    false    221            \           2606    16533    favourite_restaurants PRIMARY 
   CONSTRAINT     s   ALTER TABLE ONLY public.favourite_restaurants
    ADD CONSTRAINT "PRIMARY" PRIMARY KEY (id_favourite_restaurants);
 I   ALTER TABLE ONLY public.favourite_restaurants DROP CONSTRAINT "PRIMARY";
       public            postgres    false    224            `           2606    16543    menu PRIMARY00000 
   CONSTRAINT     V   ALTER TABLE ONLY public.menu
    ADD CONSTRAINT "PRIMARY00000" PRIMARY KEY (id_food);
 =   ALTER TABLE ONLY public.menu DROP CONSTRAINT "PRIMARY00000";
       public            postgres    false    226            c           2606    16554    restaurants PRIMARY00001 
   CONSTRAINT     X   ALTER TABLE ONLY public.restaurants
    ADD CONSTRAINT "PRIMARY00001" PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.restaurants DROP CONSTRAINT "PRIMARY00001";
       public            postgres    false    228            e           2606    16562    regions PRIMARY00002 
   CONSTRAINT     [   ALTER TABLE ONLY public.regions
    ADD CONSTRAINT "PRIMARY00002" PRIMARY KEY (id_region);
 @   ALTER TABLE ONLY public.regions DROP CONSTRAINT "PRIMARY00002";
       public            postgres    false    230            g           2606    16582    shopping_cart PRIMARY00004 
   CONSTRAINT     h   ALTER TABLE ONLY public.shopping_cart
    ADD CONSTRAINT "PRIMARY00004" PRIMARY KEY (id_shopping_cart);
 F   ALTER TABLE ONLY public.shopping_cart DROP CONSTRAINT "PRIMARY00004";
       public            postgres    false    232            O           2606    16448    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    218            Q           2606    16457 2   personal_access_tokens personal_access_tokens_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);
 \   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
       public            postgres    false    220            S           2606    16460 :   personal_access_tokens personal_access_tokens_token_unique 
   CONSTRAINT     v   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);
 d   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
       public            postgres    false    220            i           2606    16596    reviews reviews_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.reviews
    ADD CONSTRAINT reviews_pkey PRIMARY KEY (id_review);
 >   ALTER TABLE ONLY public.reviews DROP CONSTRAINT reviews_pkey;
       public            postgres    false    234            V           2606    16486    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            postgres    false    222            X           2606    16470    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    222            Z           2606    16476    users users_username_unique 
   CONSTRAINT     Z   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_unique UNIQUE (username);
 E   ALTER TABLE ONLY public.users DROP CONSTRAINT users_username_unique;
       public            postgres    false    222            T           1259    16458 8   personal_access_tokens_tokenable_type_tokenable_id_index    INDEX     �   CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);
 L   DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
       public            postgres    false    220    220            a           1259    16544    restaurant_idx    INDEX     H   CREATE INDEX restaurant_idx ON public.menu USING btree (id_restaurant);
 "   DROP INDEX public.restaurant_idx;
       public            postgres    false    226            ]           1259    16535    restaurantid_idx    INDEX     [   CREATE INDEX restaurantid_idx ON public.favourite_restaurants USING btree (id_restaurant);
 $   DROP INDEX public.restaurantid_idx;
       public            postgres    false    224            ^           1259    16534 
   userid_idx    INDEX     O   CREATE INDEX userid_idx ON public.favourite_restaurants USING btree (id_user);
    DROP INDEX public.userid_idx;
       public            postgres    false    224                   x�326�4�4�226�46 2b���� %\         �  x��Z�v��}&�?�,�J�5��~%ٱ�vӬ��:nnM��7I$m��_ ��{�f����!��38s���٬�����+��w봿H�c�v�v���ݺ_}1˪���$������; |��!�v���EI|5��/f��8~�#u�
�xJ��O��m��n߿����vVt�:anO(��+�%?v����W|������`��W�������&����Uw+���ͬo���ȓ�2-��{�����H��#p�X�}�Zo��^K��R�b4E�[�f����tnyv�Xia�Y��t�3w���ࣛA�?[$�|ֽ}�KӲ;ꏿ�ڗ�:��u�jwH6�nS� �y�m�WQ�� ���
���&���+������/���mw;�M�S1�h��;l� ��7̋~O�3��� ���u&|GM�����p�����*�EX�I�ϛ�>~Ik,��C��₏6z%��_�֭��A�ܿ���/_C�6�֌�n�Sv��v��D,�a��;L'ouS�����	���Q�i���٣�W'9b�;c7��q8f�g�0ϭ�y�R�@F���72i�+�����`7<EɯXީ&|`��y��ݩu�h�E�#�~������m�������!=��O��-c�"�\���!���%w���������C�!n�|z 29���n=��$b�סr�<��A��a2S�ǚ����4�5ݍ;%g�`9`$�!A3��ܡ����L*�d��l�b��bt�2)ʙrl�Էy�Sս�� z�ql6� \1ⷪU:n,�ݽ�lҧU����e݃3��HV��ĉ�2@IgA�*|֚�O�yR4����%����J{�,�{w�L��/�*0�oC[Mz�ܡ�������n�*fAhQ(3-�����©�5��F���IB-���D�5a�Z������iB٧�����a:���D㝈�� �X>�\�f!QL2T�]�q$�+fV�_�z��F�P��&4�,Oʚ���R���ԱW��'va��i/�ˍYO���W�5t?+�^e~�9�.��a�?;9������E��Z��\a�<v��
����F���Ѯ�2"C#�?�!٪ND��ғ@�|�8�/�pL�<eR��?�68��Vma�w&��TK������K0��=9y|��r�����,�8������&n8�*rB]��jf_~��I�x!P{���RJ�Cj�2�TZc�p��5�O�8�NY�E�\Klf�q7�g��:�sӳW�hQax��.����R75���E:A���d~�~oA{�"�9*�ޣ/��b���h���<
1M-�n�G�+�>�	��w�Zd�',��)���0�l��'�Q�)�r�,L;���[m��ԑPV�X A��;N]��q�2=���x��o8��ig&P�N|+�t S(� x����N�a��h�,�g{��*�w��0���R䒆�2�Y��Q{2/�1��#,�'��&�X��	�D��z���c�'���Γ�r�xh؁��|��Qk�}��Y��f,���
�4�y��~8t���`2#6�5݌f&V�R��y3����I�?������9]h�Q9�BKA��A܈=�4�֌��HG��6 ���A^$��>���U�6B.	H�>��sT���b��@�,�̀�j�}Z�)y�qM�#�!Ru)S���ѐw�B�#퉴�1(�Q��i�P�,'<n�'�k��2�Nb��� ����U �Us�F�X&S<J�U5)�x	�hO�qJ��c�2s�ޖ�avv&����ܩ�����8�n�>���t���V9�c \U� k���\B��VvT���䬆N9�j\D���#�"o�,�z8��1��;D����C:.`H�C刋Q�X -���x�Ĉq)�N�3.Q��~�t#ja���?�L�A�,�8�9%�c#����$�x��u}���pZ#*?%ԑ
�shOy�������"�)�)����Ǖ�n�i	&mc
R�͍Y:�����+K�����lwY�9 ��
w��XT^��<U�1)�~ ���śޚ�`H�c�.�c�$�w�����b��j}nk�~��Dlf>7��h��:F޶�xmw������Ӣ����Huj؇^��IKy��$t�Q�h*H��j�F�GlI�����TC��/�VB3!�##�%��*�o�Jk�a(�8�I����/Z�|&#-�a���]At�N���>愔�C�P��ȗ�8p�xi����N9�-55����N�����Zk+��!�D%|�[��&ʫ8WM2m�)#Օ����l��SUs��W�m�kT����2�����؁=���ϰ�0�)��ٯ����ZWQ��+ѓ�F����Q�"���5�����wu��)��0�HFR�	*j_ۡU.�%��؆	{�^7y��`
�s�b��r���WجRlFQ����KF43��q���[۷�A_���o�e㙽���4���}򵡢����.��`a�A��hR\6Y�k.ZOԟ��ЍA�7�qxrđD=�WZeѷ爥S��	�{�0f
z�a���}\1�~���o��ᵉ=�)C=�������/�s|j�AT,�.�O� %��?�D�.ݺ~��Dq��������K��	�y��Ȯ�Dgj��~�MW05�6�����x���������Cl�dq��> ����g4{W[I%�xF���MDB�s�v�)�t����߄�2��HK���L�#9���8m�"C��r廚�#��f�b���0"��N9:���X�nh#
�gy:DX��9y*1�y/���ed%�������s���l&k³����)���C��s�s��=$d���(�ۏ*�X>�����
\k� �� ����� mI�j2-Eһʁ��復o�ji_�xO��(Dc��Vmd�$԰��Nٸ;�H�l��0��"l<=} ���z�ft�}g���߻���*�)�{��`Ğ~'"�(�̖f|��rq�L>���$I��=lS      �   z   x�]��
�0��u�a$s)4�"c���������`<���~�(`T$E�p5����R�l�ZJ^��}���n�O�KbŠ�(��x�Q{�������fG��g�/�^p`���5��� o�4;�      �      x������ � �         %  x�5�]J�P��3��
�sm����4V}���
����i�h0&k8�#��Ň���9�e��E�
5F�أ�%U#�[QԨ���w�P��E˱?'x�먌�e���A�h�;*pO�����COtv)'�ª���/:�܍�vƍC���Z�9<Z�)Y_��T��}e���FRљg�@=w��o�[t������(�7��%�w)ъ�w�<�'�wH�z�/�=����gok���h�YK"�֩}v���و���u uvŕ���� ~�8a"􇭸"������遈��� �            x��]Is�>~Ŕ/�@�H�Z��e;	-�)�%U�5&F14*щ�Dە�����bWl��*���1�z���GyK���C�bb�3�Xfz�_�����b���~��3
�z�g��������j[���h�߭�m����m9�m���ѶV�ѻλ���?�C�G���+�Q_1�9|5���.8��&��������)~8����Ջ� ^��Q��95��	�?���J��'�����ϟ��3�VWLF���� �yf҇cxs��&MyHW�򝗞�g9<����c�r��/�]{N/<�F>��~I��)�0a��<��?çL�J�r�d+�c��؟]�H�>\<«��0T8�>Ƙ���q�`?8����S"�!���k`~p�x(=>|�)~ET<���x�"m��UN��z`f�4kDJ�}#$L�C�m ��#Jy@ ��?�)Ìx���ZY�j^1��^���,8i��5q���U�U�^�̟���c)����հەG�[J�߭bZ��Ř~x��$𪾅�{�)r����܎�'�����4�Tꀉ8'�BnC&#/�t��M�h^x�&Hl�e����X`8;�U~<m~v��GB9��}��Kq	l'L�6f�����4��>��O�pŐ�s���D	���>��a	B���Y��x������^���\��C[�,~PZ÷�0�v?�Y�@yC�E��N����@aވ*Κ����#�uz�,ӋXC���YꙊ���C"f3�p����)f�����+p;�t]�f � �>���Q[�;�3�\� �K�5��a�U	?��
����#\�Hōic����>�m�.H��g�X���a��/-U�{�#�U��*�i���Ck��Ų�v�E ?Sk@/��2�C"�.jN��
�@`�J!&a���Ӕ�ĂKx�@�;㱚`]N���֏h���t�,LeVNS����~N2xN3�Ŗ9a��{@{ȸDB�CJ�cu�T�Ef��p�RF����Cw�*HVCx�����RY���'������}�f�u�^�r̻�Φ�b�f�i��mKϗ����l#
����$��re���#cGVp=GhM)U.��G�:�X>))��x�X~�
nW��9�ې.@�/bC���ْ��;���"����AbG�4�/�R�ᡑ���TJZ���*��!���o��d H+�Z�і�%8&4�T�GY]�	14�nЌqy�fA����Xg&!@�l��y~(}�u|Je\�,fd�'��ȗ���C&JV�zCJ�G":-]3޲�w��6߱�NK%L-�a�m:ZYJ� �i��S�E��D���(�~�1AKڠ#�J�D|�XםE�Cy"0�V��J�Gd�R�W'1Â}�1M��~�����1�\6�_�(���x.<∄9���Zw��pր$�Z$&- 2�fD���ܒ1��/]O23�-����~��H�*�*��`3����u㮵\�d���t�m5{�![-���!�M��v�f�]$=��	[]�Q��=�^Dr�~��ef��p�%<�����Q;I� f��:��T�҈0�y0��TQ�6"/���Cj�t��@�G���b�F8���qO#�S��َ���I#��q�zj4���9�{D����L$�X��C�b��� 4��S�V���)�rF�A�q�i=p�����Uk��<}���+�]��H1 �$F��Ӥ��}��J�ђ\a+�h9�#h�H
��|�A����o�6��ɯ����vY��!���%�0�g��d,�њ q��֓A����!DV7��74k�&���#�HeAT����Y(�'������k�s����'VS�y�K`��!�j
suO�Sz ���91-����9�K|v""3���wd��ˏi���q�� C���Gd�a5d��I���!v"��Oh��l�3(x�{FD��rȷ,	cS��w>���I��r��D'T�P�1��®Wn��y�}Tn�ߥ�����nnp���T��n��g�!.4mu&?���u&�&��v"��*��<1� ��!*��pc�>p�S�
��dIg�E��ϱDԱ�X�\�L�82
���XvH�X�$"�
�a�J�)��Dj�!̛ʔ���N���tPĻ��S�AH2��FaHi�{�I"�����Rdr�H���X���m�VV�����M�7��m[�����h�.�ьu�[�!g~�T8�gDHO��.'��H�oG%h���l���bI+]���u�M̛��
�gJ�}Wn"p�O�"��B �_�F
K��L�S*"�:����]
g"�sD%��l�Xk�<Τ�>�pRZY5��l࠭�Ӫ��t���嶛�K���=�U�CVG~�0B6�K�R�3��D#ٱ^��B��Ɯ98B\J�"1t\�Nhf���ѡ�l�"y2S��|*�БඩЬf��e�5�	,��u�1nz�S錘��|?��M���o��T蓊��[�tOgܾ Ϗ��V֌_uZ-���Yu[�5��{�����kb-��Z ���zY|;#�����8aW5�vA3�TP��އ'�%��z_�b1@f&�XU�<�W�����P�{�'�c"u��2#3��l�ȎJ�{��M���$-�w�����,,��R5n۝vk@q�������jvs�nX��֬�͚��S�M�٩�|��ޟ������y}� -f(q��F����Gq&?=�#>��)6�(�@�#��]{$T��e9��^!�j&O:<������$}&d�	4�铤��#�a�Q$Jf��􁈃�/��.�B�8X�J�})i�<�nܪ��[;v�A��M�PU��v�n��m�- �\I�sq=����j�ǹ1��M���$1N�Y��w�d ̓�����f�EP�!��I��e�H���1���EN�XI/�I���aTB�z�39 =.�T5=�'�ji�+6~ 3�|9Z�� H}��g_���LK+׌�v��oԭ=���!^��u}�,u���)� �������&����Ts���()S���'��j,�k]B�g}?!�%ü]�M�\�BD␮�������Fh�����R�6���0͠dmM�f�"[A��})#�g�̻})�Bե����n��D�,%�6�w�E��!OELi �f����4��u�Ǎ�~X(B�����'g�9Kd�%�0�$~r�_`����x���9��C��:Y��Lp�0B�0׫�F�8%����$�3$�)���9��u�l)e�+S"E���O�Ji����Wd˺ڕƭN��ĺXa�?s;-�ML�������Z.�A� �*�צP���5��j��:ރ�RMD�^&!-��SΙ�!��YY�Z�GD]M�|��\�O��(�(���L�Th
�fȡ�n�0!k����J�Ԥ���X�/�Z-�΅<̘�'���Tr�o¡T��d�W,%�������C�j!�nZ��2�p�z�͎���+nt]�zL���%�Fu�qd�5&��T�}2z�������	�C�������p���ω0���~�hwV�u��~gT}���/��p��H���u�6��ht�	4B7� �X:SҒ�UB��n�ѥ��V�n��74n;����e�� ����_*e�-�I��1d`b�$�b�i�U�4E�y�o��{��H�ƾ��Ǆ�v���J2]�!I/��/NKfX�Й�q�?FS)_L<���I��i�&M/ؗ���"QzQ�AL����Bx�2T�Y�	)�0�Oy���s��Ȼ\]I�ȩD�im���nC-J�������ߞs�
oiu�xljW��5T�۝����M'�/:�~ĝo�)��-�b��)���+ZT��������oE��9=�&�b��U����_t�m�m�x��t1����EG\��[�#���82��*��ç~���KW���Q0�ukk�җ7,1z�IWt���u�����i�Yi������Bh5��5��>��Q��vE����}��57�nl��� ]  �pڛ5[e��i=��z�K�_���w?�޻Q��YZ�a�S�w06���O)�C����Zh�I�h�SY�|��Q7�d[�h��V�n:9,�7^��w����/���ٗ8#�*JG�Y���sd�|ԝ��p�ou�;�D�F.z��޿J�_t>�ڊ��5Hv|�d�6��3��#���ζ[w���n\0p�"��8-��4a�9^k�zN���"T���J�����/��+��B�r㢯p����@��5Y��!�d���z�i�jS����o�Hm4p���6Ĕ�[�!.ц۵V�٥)?���N�g����ɪ����+��^l�E1ex-�ߩE�S����a-��u��Xץ��T"6V0��wv�.^t4��vPt4^���/��?0l���D�h39[�@蔪d�+��?��0�^4AM�
KEz%�"M��#�֮cc�,c������vw�y���E{��=2{��>u-~��=��N���ذEe�A\net���M����B@�C�Qqs���=
G3T�OY�S~o����ɪW�lŘ�"�
�B�[i�v���#�EC�E�eD�}�e�Ե�q�im���R���ζ�V�n.�.���Kn���V]56������nXO�u��î�!
�/������m�0���j��e5�T�W���|�g�H����NӢ�T�i�<��Z5�Xͦ�mo��OY�����5�E��VØJ�~�Ǐv��o4���6;�����:�mí�u7��X�@EELQ�DEL*A*q�^ã4:�z���٭;;v#�$�p�"IT$�.5Iπ�g�^7n���������/�F�S�soj�"�S�{����ds��sЪ7�,s�zPW[M7����E	�(J�.O�g��V��	�F���q��� E]TQ��⼺(���� ���ƫv�n��u6����7��v^!w���Ծө}�I��h���׽ͻ�V����[��y��۹��8|�8|�u�H*!�=�m�Zxֻ�Wa�ݞ�0������(�T��J�%8[�nܳv������bk�I#��.~�CĲ�~�C.i�I�E�����^m�ޱ6k9?r��8�Fv��7���7�Yt���*�R�?��PM      
      x������ � �         �   x�U�A
�0EדS��il�w�0Q
�
nݹ�e��jz�?7� �b�y�8_�H�u�'�e��u�(�,q�P�����I{��3@��NI;�x#Y�5`_�͒_�tV�:Vt�0�.H+��̍_̤�~T�m�le0J�'�Ƙ�j       �   }   x�3���L�ٙ%���e�y�e�IezI�*F�*�*�>�N��F�e�Y�əEzF���In)9����>f.&�����!��i����f�1~�FFƺ��F
FV�fV���ĸb���� ��&Z     