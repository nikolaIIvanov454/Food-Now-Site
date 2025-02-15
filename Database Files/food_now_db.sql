PGDMP      3        	    
    {            food_now_db    16.0    16.0 J               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    16677    food_now_db    DATABASE     �   CREATE DATABASE food_now_db WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_United States.1252';
    DROP DATABASE food_now_db;
                postgres    false            �            1255    16678 !   temp_import_view_insert_trigger()    FUNCTION     _  CREATE FUNCTION public.temp_import_view_insert_trigger() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    INSERT INTO temp_import_table (name, image_path, description, price, region, created_at, updated_at)
    VALUES (NEW.name, NEW.image_path, NEW.description, NEW.price, NEW.region, NEW.created_at, NEW.updated_at);
    RETURN NEW;
END;
$$;
 8   DROP FUNCTION public.temp_import_view_insert_trigger();
       public          postgres    false            �            1259    16679    favourite_restaurants    TABLE     �   CREATE TABLE public.favourite_restaurants (
    id_favourite_restaurant integer NOT NULL,
    id_restaurant integer NOT NULL,
    id_user integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 )   DROP TABLE public.favourite_restaurants;
       public         heap    postgres    false            �            1259    16682 1   favourite_restaurants_id_favourite_restaurant_seq    SEQUENCE     �   CREATE SEQUENCE public.favourite_restaurants_id_favourite_restaurant_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 H   DROP SEQUENCE public.favourite_restaurants_id_favourite_restaurant_seq;
       public          postgres    false    215                       0    0 1   favourite_restaurants_id_favourite_restaurant_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.favourite_restaurants_id_favourite_restaurant_seq OWNED BY public.favourite_restaurants.id_favourite_restaurant;
          public          postgres    false    216            �            1259    16683    menu    TABLE     �   CREATE UNLOGGED TABLE public.menu (
    id_food integer NOT NULL,
    name character varying(55),
    weight character varying(55),
    price character varying(50),
    id_restaurant integer NOT NULL
);
    DROP TABLE public.menu;
       public         heap    postgres    false            �            1259    16686    foods_restaurant_id_food_seq    SEQUENCE     �   CREATE UNLOGGED SEQUENCE public.foods_restaurant_id_food_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.foods_restaurant_id_food_seq;
       public          postgres    false    217                       0    0    foods_restaurant_id_food_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.foods_restaurant_id_food_seq OWNED BY public.menu.id_food;
          public          postgres    false    218            �            1259    16687 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false            �            1259    16690    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    219                       0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    220            �            1259    16691    personal_access_tokens    TABLE     �  CREATE TABLE public.personal_access_tokens (
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
       public         heap    postgres    false            �            1259    16696    personal_access_tokens_id_seq    SEQUENCE     �   CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.personal_access_tokens_id_seq;
       public          postgres    false    221                       0    0    personal_access_tokens_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;
          public          postgres    false    222            �            1259    16697    regions    TABLE     i   CREATE UNLOGGED TABLE public.regions (
    id_region integer NOT NULL,
    city character varying(75)
);
    DROP TABLE public.regions;
       public         heap    postgres    false            �            1259    16700 ,   restaurant_regions_id_restaurant_regions_seq    SEQUENCE     �   CREATE UNLOGGED SEQUENCE public.restaurant_regions_id_restaurant_regions_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 C   DROP SEQUENCE public.restaurant_regions_id_restaurant_regions_seq;
       public          postgres    false    223                       0    0 ,   restaurant_regions_id_restaurant_regions_seq    SEQUENCE OWNED BY     f   ALTER SEQUENCE public.restaurant_regions_id_restaurant_regions_seq OWNED BY public.regions.id_region;
          public          postgres    false    224            �            1259    16701    restaurants    TABLE     X  CREATE TABLE public.restaurants (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    image_path text NOT NULL,
    description text NOT NULL,
    price character varying(255) NOT NULL,
    region character varying(50) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.restaurants;
       public         heap    postgres    false            �            1259    16706    restaurants_id_seq    SEQUENCE     �   CREATE SEQUENCE public.restaurants_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.restaurants_id_seq;
       public          postgres    false    225                       0    0    restaurants_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.restaurants_id_seq OWNED BY public.restaurants.id;
          public          postgres    false    226            �            1259    16707    reviews    TABLE     P  CREATE TABLE public.reviews (
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
       public         heap    postgres    false            �            1259    16712    reviews_id_review_seq    SEQUENCE     �   CREATE SEQUENCE public.reviews_id_review_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public.reviews_id_review_seq;
       public          postgres    false    227                       0    0    reviews_id_review_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.reviews_id_review_seq OWNED BY public.reviews.id_review;
          public          postgres    false    228            �            1259    16782    shopping_cart    TABLE     �   CREATE TABLE public.shopping_cart (
    identifier character varying(255) NOT NULL,
    instance character varying(255) NOT NULL,
    content text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 !   DROP TABLE public.shopping_cart;
       public         heap    postgres    false            �            1259    16717    users    TABLE     :  CREATE TABLE public.users (
    id integer NOT NULL,
    username character varying(55) NOT NULL,
    email character varying(75) NOT NULL,
    password character varying(255) NOT NULL,
    role character varying(25),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    16720    users_id_seq    SEQUENCE     �   CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          postgres    false    229                       0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          postgres    false    230            B           2604    16721 -   favourite_restaurants id_favourite_restaurant    DEFAULT     �   ALTER TABLE ONLY public.favourite_restaurants ALTER COLUMN id_favourite_restaurant SET DEFAULT nextval('public.favourite_restaurants_id_favourite_restaurant_seq'::regclass);
 \   ALTER TABLE public.favourite_restaurants ALTER COLUMN id_favourite_restaurant DROP DEFAULT;
       public          postgres    false    216    215            C           2604    16722    menu id_food    DEFAULT     x   ALTER TABLE ONLY public.menu ALTER COLUMN id_food SET DEFAULT nextval('public.foods_restaurant_id_food_seq'::regclass);
 ;   ALTER TABLE public.menu ALTER COLUMN id_food DROP DEFAULT;
       public          postgres    false    218    217            D           2604    16723    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    220    219            E           2604    16724    personal_access_tokens id    DEFAULT     �   ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);
 H   ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    222    221            F           2604    16725    regions id_region    DEFAULT     �   ALTER TABLE ONLY public.regions ALTER COLUMN id_region SET DEFAULT nextval('public.restaurant_regions_id_restaurant_regions_seq'::regclass);
 @   ALTER TABLE public.regions ALTER COLUMN id_region DROP DEFAULT;
       public          postgres    false    224    223            G           2604    16726    restaurants id    DEFAULT     p   ALTER TABLE ONLY public.restaurants ALTER COLUMN id SET DEFAULT nextval('public.restaurants_id_seq'::regclass);
 =   ALTER TABLE public.restaurants ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    226    225            H           2604    16727    reviews id_review    DEFAULT     v   ALTER TABLE ONLY public.reviews ALTER COLUMN id_review SET DEFAULT nextval('public.reviews_id_review_seq'::regclass);
 @   ALTER TABLE public.reviews ALTER COLUMN id_review DROP DEFAULT;
       public          postgres    false    228    227            I           2604    16729    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    230    229            �          0    16679    favourite_restaurants 
   TABLE DATA           x   COPY public.favourite_restaurants (id_favourite_restaurant, id_restaurant, id_user, created_at, updated_at) FROM stdin;
    public          postgres    false    215   ,]       �          0    16683    menu 
   TABLE DATA           K   COPY public.menu (id_food, name, weight, price, id_restaurant) FROM stdin;
    public          postgres    false    217   e]       �          0    16687 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public          postgres    false    219   Qi       �          0    16691    personal_access_tokens 
   TABLE DATA           �   COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
    public          postgres    false    221   j                  0    16697    regions 
   TABLE DATA           2   COPY public.regions (id_region, city) FROM stdin;
    public          postgres    false    223   "j                 0    16701    restaurants 
   TABLE DATA           o   COPY public.restaurants (id, name, image_path, description, price, region, created_at, updated_at) FROM stdin;
    public          postgres    false    225   Wk                 0    16707    reviews 
   TABLE DATA           �   COPY public.reviews (id_review, username, stars, review_description, id_restaurant, id_user, created_at, updated_at) FROM stdin;
    public          postgres    false    227   �                 0    16782    shopping_cart 
   TABLE DATA           ^   COPY public.shopping_cart (identifier, instance, content, created_at, updated_at) FROM stdin;
    public          postgres    false    231   V�                 0    16717    users 
   TABLE DATA           \   COPY public.users (id, username, email, password, role, created_at, updated_at) FROM stdin;
    public          postgres    false    229   s�                  0    0 1   favourite_restaurants_id_favourite_restaurant_seq    SEQUENCE SET     `   SELECT pg_catalog.setval('public.favourite_restaurants_id_favourite_restaurant_seq', 42, true);
          public          postgres    false    216                       0    0    foods_restaurant_id_food_seq    SEQUENCE SET     M   SELECT pg_catalog.setval('public.foods_restaurant_id_food_seq', 217, false);
          public          postgres    false    218                       0    0    migrations_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.migrations_id_seq', 8, true);
          public          postgres    false    220                       0    0    personal_access_tokens_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);
          public          postgres    false    222                       0    0 ,   restaurant_regions_id_restaurant_regions_seq    SEQUENCE SET     \   SELECT pg_catalog.setval('public.restaurant_regions_id_restaurant_regions_seq', 28, false);
          public          postgres    false    224                       0    0    restaurants_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.restaurants_id_seq', 1, false);
          public          postgres    false    226                       0    0    reviews_id_review_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.reviews_id_review_seq', 10, true);
          public          postgres    false    228                       0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 5, true);
          public          postgres    false    230            M           2606    16731    menu PRIMARY00000 
   CONSTRAINT     V   ALTER TABLE ONLY public.menu
    ADD CONSTRAINT "PRIMARY00000" PRIMARY KEY (id_food);
 =   ALTER TABLE ONLY public.menu DROP CONSTRAINT "PRIMARY00000";
       public            postgres    false    217            W           2606    16733    regions PRIMARY00002 
   CONSTRAINT     [   ALTER TABLE ONLY public.regions
    ADD CONSTRAINT "PRIMARY00002" PRIMARY KEY (id_region);
 @   ALTER TABLE ONLY public.regions DROP CONSTRAINT "PRIMARY00002";
       public            postgres    false    223            K           2606    16737 0   favourite_restaurants favourite_restaurants_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.favourite_restaurants
    ADD CONSTRAINT favourite_restaurants_pkey PRIMARY KEY (id_favourite_restaurant);
 Z   ALTER TABLE ONLY public.favourite_restaurants DROP CONSTRAINT favourite_restaurants_pkey;
       public            postgres    false    215            P           2606    16739    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    219            R           2606    16741 2   personal_access_tokens personal_access_tokens_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);
 \   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
       public            postgres    false    221            T           2606    16743 :   personal_access_tokens personal_access_tokens_token_unique 
   CONSTRAINT     v   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);
 d   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
       public            postgres    false    221            Y           2606    16745    restaurants restaurants_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.restaurants
    ADD CONSTRAINT restaurants_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.restaurants DROP CONSTRAINT restaurants_pkey;
       public            postgres    false    225            [           2606    16747    reviews reviews_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.reviews
    ADD CONSTRAINT reviews_pkey PRIMARY KEY (id_review);
 >   ALTER TABLE ONLY public.reviews DROP CONSTRAINT reviews_pkey;
       public            postgres    false    227            c           2606    16788     shopping_cart shopping_cart_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.shopping_cart
    ADD CONSTRAINT shopping_cart_pkey PRIMARY KEY (identifier, instance);
 J   ALTER TABLE ONLY public.shopping_cart DROP CONSTRAINT shopping_cart_pkey;
       public            postgres    false    231    231            ]           2606    16749    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            postgres    false    229            _           2606    16751    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    229            a           2606    16753    users users_username_unique 
   CONSTRAINT     Z   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_unique UNIQUE (username);
 E   ALTER TABLE ONLY public.users DROP CONSTRAINT users_username_unique;
       public            postgres    false    229            U           1259    16754 8   personal_access_tokens_tokenable_type_tokenable_id_index    INDEX     �   CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);
 L   DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
       public            postgres    false    221    221            N           1259    16755    restaurant_idx    INDEX     H   CREATE INDEX restaurant_idx ON public.menu USING btree (id_restaurant);
 "   DROP INDEX public.restaurant_idx;
       public            postgres    false    217            d           2606    16756 A   favourite_restaurants favourite_restaurants_id_restaurant_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.favourite_restaurants
    ADD CONSTRAINT favourite_restaurants_id_restaurant_foreign FOREIGN KEY (id_restaurant) REFERENCES public.restaurants(id);
 k   ALTER TABLE ONLY public.favourite_restaurants DROP CONSTRAINT favourite_restaurants_id_restaurant_foreign;
       public          postgres    false    225    4697    215            e           2606    16761 ;   favourite_restaurants favourite_restaurants_id_user_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.favourite_restaurants
    ADD CONSTRAINT favourite_restaurants_id_user_foreign FOREIGN KEY (id_user) REFERENCES public.users(id);
 e   ALTER TABLE ONLY public.favourite_restaurants DROP CONSTRAINT favourite_restaurants_id_user_foreign;
       public          postgres    false    215    4703    229            f           2606    16766    menu fk_restaurant    FK CONSTRAINT     �   ALTER TABLE ONLY public.menu
    ADD CONSTRAINT fk_restaurant FOREIGN KEY (id_restaurant) REFERENCES public.restaurants(id) NOT VALID;
 <   ALTER TABLE ONLY public.menu DROP CONSTRAINT fk_restaurant;
       public          postgres    false    217    4697    225            g           2606    16771 %   reviews reviews_id_restaurant_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.reviews
    ADD CONSTRAINT reviews_id_restaurant_foreign FOREIGN KEY (id_restaurant) REFERENCES public.restaurants(id);
 O   ALTER TABLE ONLY public.reviews DROP CONSTRAINT reviews_id_restaurant_foreign;
       public          postgres    false    225    227    4697            h           2606    16776    reviews reviews_id_user_foreign    FK CONSTRAINT     ~   ALTER TABLE ONLY public.reviews
    ADD CONSTRAINT reviews_id_user_foreign FOREIGN KEY (id_user) REFERENCES public.users(id);
 I   ALTER TABLE ONLY public.reviews DROP CONSTRAINT reviews_id_user_foreign;
       public          postgres    false    229    4703    227            �   )   x�36�4�4�4202�54�50S04�20�2�*����� ��      �   �  x��Z�v��}&�?�,�J�5��~%ٱ�vӬ��:nnM��7I$m��_ ��{�f����!��38s���٬�����+��w봿H�c�v�v���ݺ_}1˪���$������; |��!�v���EI|5��/f��8~�#u�
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
\k� �� ����� mI�j2-Eһʁ��復o�ji_�xO��(Dc��Vmd�$԰��Nٸ;�H�l��0��"l<=} ���z�ft�}g���߻���*�)�{��`Ğ~'"�(�̖f|��rq�L>���$I��=lS      �   �   x�m��
� ��s�0�Dm����-j�ן���\��(v$�0�b�=�.y[</>����9�3���{�}�@�$�(�F&�I�V���;$�?�(�`��5�P��\�B
�����ߍ*v�,T�Y�7z�[\��w�����q�����2����쾇� >�]�      �      x������ � �          %  x�5�]J�P��3��
�sm����4V}���
����i�h0&k8�#��Ň���9�e��E�
5F�أ�%U#�[QԨ���w�P��E˱?'x�먌�e���A�h�;*pO�����COtv)'�ª���/:�܍�vƍC���Z�9<Z�)Y_��T��}e���FRљg�@=w��o�[t������(�7��%�w)ъ�w�<�'�wH�z�/�=����gok���h�YK"�֩}v���و���u uvŕ���� ~�8a"􇭸"������遈��� �            x��]Ysו~n��.���IPˣ�Ih9�H3�*U�j-�h�艛Dە13v�&���Vj�*o�����x�?����,��zo�����U�����]��힋5#�Cx�q�3��xf��g�g��v�궬f��~�����r:���u?p��iU�}�|b���(<�۰�Yxl��m�]3��W�`L��ˠg>�=�;.��cxy_�	��5~��/�s3���K�����{�z
8
O�/���\P�z��J��B}�>���3x�3��#���lg<���A�>�ЗC�|/�q�sz��E�����K%tۀ����>eFW#��
?�O���	��c�
������#��)u�;0�x������9��Ux����G9ǯh/��^��8��}nV��������L�g��tA���ۆb�<�)&��e�Ϩ��#��yըU7���L��qP5�H�a��0��n����w�F�2ޱ����k�iw���w�8Nޭ��ǽ�VB�Ȅ�}x	p=���ؾ���9b��w�.J���s���i�;=��!��:⩜�s5BzŤ�Gt�_1ܼ�
�r� �S��|W� ;>^[~<A ?\��HZal��H��:	]���2MC��/��s��b�"�#�\}""9x��#��7�k�
�l0����&��-�H@g?�����n�!
,�i�;M��W@�E-��5c�K
/�Gr4�9�x0X/��AZ���3+TD��,P6�sZ�l��H?�%��^�� H�Ϧ�}����y�x!���)N�x��j��?`��,F�G{��&�03^Oh"�2��� (���$�}���5���|`խ�
�{��zj�u��ݮ]L��Z'z�R������ 	ڜ�`&��'��rO]������I���c��ڝ.{+ ��ȍ��,RVW3^����N�xI=�'�9e-�k@�_�B�$�Fm��x�A����X��L��I�����RC8�N��Zu#I�_�h7�����b�:7�Gu�1�;۶
���ӱw;�����l;
S /|I�H���5-4W0%9����:A+K����<B�8ge���QB�g�7�+�#x̜�nD�Y��
�����N|;]D�dx:H���F��1[�C4E42�Jy��>�r=�?q�<�R�ʮ���w��I�)�5ӬQ^o}E�&��gl(d`�~��3M�g3%��C黿&�T���)J#;?%v^Nʤ��0�I@��!��nI��HPgB�n���v��[-����ݴ��D�[�R5gCG��Z�T�ـb�"���h&k�̤�"�!/�ug4/DˑT1'U%�c��h�R�$�T-	S�=�	6Mn�a�%��"[�)*a6�5�^�\<qB"iz��-��)�I�r I���I���#�f���K2�I�EBLד�yɄy8&�ƪ&�����d�.�&�)-���Ck��Y�m9�ڶd|g�e�|�A�L��{YG�.=��	 �/,y=�
%=A�������+4�+��p�%U��4���>Q�P;z�7xuz-�ܥq?dzе�xQ8�&o�	�]ߟ`mZt�`�"o �)ň� pGY��Ɣ�6��C�X9���N����뫙Y()r��Ȥ�'�Ja[ē#�e
��4�7�_�W�=�5�rAS[-��;-�c5͏��zGE�w�������L˴�F�0�b���ҋ�!uJ��h`D�� '4��ٴw���K?Mæ/�}��`1N��v�����.��X�����(��&C��Wb*�|��}AB!��'-9�87ym������CNE<H��&�MQ5���"	>P�m<����*:/��ѝ+����1����Q�2S����9A�F��c���D����"���b(���	���ri �a���$#��(��.�P�!�,�4����&"�S�%�L�1�To5��;���*Z�;_-=I�2����	U(`u��Q���-�?��8@E��-��v�x���m ��@�@�j!h�m}�-��B�W� sOhhҚ�U�o�"����K)�&sZ2PED!2a��F>���8dL��,��o�m���%��ZH�,)�;�h�&ɟ�OY\(V���X��,&R{��߬\f��TȘ�#t/��b�+O�V�"	��fb4#҆�8�Db�ɕI$<��4懱�)q�%�	��H��5����:�L�[���vU\O'��: Wd���6?��M�'r��¥V��#P�fg�����	�X�zW*�T�E��f��_�����ɥ,a�e So��1m��<hMe2'����ՙ� ��'��R 0	ngPDe3fs.}�g�i|����6�h������':(���ubx�6�ֈ�V�E�5jȧ��Y	?� JU�}녟�,�l��1�R��i��J�C�I�>$(�����erl�*5�R�c���еf���E6�!�J���u��7;j�g邠Ih?�s�S�(\��s2���פ��ٺ��_�����چ�n����#�a+�������q�ZԦZ�b��&��-�V�"�ωWq.�<��sM��E�,�5����E�3�% G��Q 6x��\U��<j�G�\��H ��gҟ"Ց&�
�4S��r�G�ֽ��je���}C��	�'qZ3���N{r���G��{u�u`7�����v��.�k�iM���(�S��'SϾX#���R@s���S�cN��챿q!BD}�M|D-l�Q́Bs'��c��D(��
�4�BX�PO�C���3J	KO}.��	FDI���b)A)�+>�3} "��)��s!��V�I�}#�*F�q��0���-]��NU�g ��ڳ;z� ڹ�ng����plD�ǅ�k�+��Gif�����+�)������f�W�n�U���2@I�9��� �I�~Gፂ�r2�D�D����
�"B�+���IE&���}�˚=ɶ�@���I4�W�%w(�ٍd���7$��S���C�E���ց�RY��nC�y�ܯc�lR4�g�%�����W��Kᑐ�?R�Ԕ!�#�TlϚ��\�����h��a�X�C��DB��S��B��-̨,E�*{$��J��DdL��䄒����4�[� �HI���t��!%ږH�i|䶞�;N�R��e}���ob�ƌ�kV�"	�Q�I��0i$�m'�`$�����?��-�e��:Z�\����^LUl��	"��?6��vz[\Dj���(f�([��4��qN�������5�4;��+��d�aČ��s���(z��*�J�T%�%C9�ow�q���p߭0̟�ݶ�V�~�4������!L�K�����v4SR6Ґt�DRͦ�To����S��\%��"c��A�b�N �^xH.�8�2��,�Lh�xȦ��1�0o!w!�
�ܤ���D@0?Z-�΅T�<�g���i�6┻�6�Ӊ�oYV$�o��O1��d�mm;ʠ�}�I�ћoC�܅�wt`��<��?�K$2���&Yf ��*3�����s�����\�g�	�o( ~I� �z����|������2a���L�s�B�$o:�J+C�U4z����d�{"�,i�'vT�rv��ݥ��2��Ɩ۲�M���s�ik��i@��sa�L�>��қ\�Hs��\o����%u�Cw�?�\�f�H�&���ɔ��Z���i��Dz>����]�-���g&�����xj�����b2�9��P?R�ĩI!	�'�b�����LI�D�d2���_�͔�=��R�y*�jY�n���TT���,��ⲻ׼EX"v�� lmW��5U9��ݦu��e��/+�~�w�) Õ���������L�Q�$��i���,k�ʚ;M��kzu��	~��T�d�����8nS��v������-��x��o�J<.��H��
L�s���S^v�X$t�oX;{�~��
��|e���
����q�X����0�?�Xf͚����B��>�-P � �  �U~e����ky������ob��ٮ�*���	��c/uY�W����k����~��~���$O	�Xnb�݁J�p�Z�O���R�Łeq���O�Knu۠(B�����
`5�S ܢ�ʊ«����Q0'���B�)^�QFrEz���BJN�n:�w���]pN͂�˚ò���Rs�=Alc���+�dR_�������#g�m��s@4\�&*c�eib.Ÿ𤱍u�*R}s���%�������m���EL����g\��1{��Ɔ�M�!�xc�m:��������#B�qå�.�3�oY��B�c�`����I���f�Dh��IrOyrU���=����Z.K#3�HY��J#�ƨ=ݏ
p66����금b��mg���_�Y��2��ò���`�J���f7pGM\��>s7"�U%���n�I�L�e�eY|��]��.S|�>�l�&�e����B�N��s���W�e�e��L�)e�7Օ��U�w�+~�f��Ͳr3�����h�.#�6��!���N�=���:β����T��V�n�"�8&���Q�P_T�
g�v�m=�/j���,+=�i��Wz�΅���[֎�4���U�Y����[O��e�gY�y�Ş���j��ֵ����-�[��I�j�6�D�JE�SV��o���چq��رZxV�]��</f����p��di���µ�p�T��Α�ՌV�e������\��)�|s��r_��/2���6�>W�4�o�{&n>w:u�C�@u�ܖ۰n�A�ʆʝ5�Κv�d���c�j7��ϧζ�`p��Ξ�,<�3j�L-���+M-%�����j7�����Oͧv�|�R[n��m�1�i���Y����D��h���ڭ�/�<��4ԶB�-8�3�D��\aT�[̗�b�:k+{V[�vt�}���[n{��G�����]V:Z.�e�:l6}D��u��hX���T�F����-�(���<]�t�`�<հ����M�+���n��h��C��z\/��7T�R���:%����y#:�^�k7��/�������r�����LrMu��M㑵o�����
��f�V���e{���e���\�-{���-��瞅�E���k�^�3ω��3y�W���ɓI�e]�u��w��_כ�         Z   x�3���L��4�L�M���KW(J-.I,-J�+�4�4�4202�54�50Q0��22�24�&�eh�Y�	ԑ���j�)�S+#lb\1z\\\ �"            x������ � �         �   x�m��n�@@���S�`�sg a�JkB�њ�4@�Q�����t�ĸ9�os�d^^Sʮ�*�j��f��vDǳ�@���4�A=�{r٘h�ǟ�-�<l�W'�}q��.cg�u���&�9A@n00p�!x��Y��Q�tE���f]�%�/�(��n��"hK�,���ndެG` b7��l����� �1�C�	�gtkRJ�G     