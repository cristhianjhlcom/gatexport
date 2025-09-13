/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.5.29-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: gatexport
-- ------------------------------------------------------
-- Server version	10.5.29-MariaDB-0+deb11u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `audits`
--

DROP TABLE IF EXISTS `audits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `audits` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `event` varchar(255) NOT NULL,
  `auditable_type` varchar(255) NOT NULL,
  `auditable_id` bigint(20) unsigned NOT NULL,
  `old_values` text DEFAULT NULL,
  `new_values` text DEFAULT NULL,
  `url` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(1023) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audits_auditable_type_auditable_id_index` (`auditable_type`,`auditable_id`),
  KEY `audits_user_id_user_type_index` (`user_id`,`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audits`
--

LOCK TABLES `audits` WRITE;
/*!40000 ALTER TABLE `audits` DISABLE KEYS */;
INSERT INTO `audits` VALUES (1,'App\\Models\\User',2,'updated','App\\Models\\Setting',9,'{\"value\":\"{\\\"translations\\\":{\\\"history\\\":\\\"<p>Gate Export es una empresa peruana especializada en la <strong>exportaci\\\\u00f3n de Palo Santo y productos derivados de origen sustentable<\\\\\\/strong>.<\\\\\\/p><p>Con m\\\\u00e1s de 10 a\\\\u00f1os de experiencia, abastecemos a <strong>importadores y distribuidores en todos los continentes<\\\\\\/strong>, cumpliendo con los requisitos de calidad, consistencia por lote y normativa aduanera internacional.<\\\\\\/p><p>Nuestro enfoque est\\\\u00e1 orientado a <strong>facilitar la importaci\\\\u00f3n<\\\\\\/strong>, brindando <strong>soluciones personalizadas y soporte comercial constante<\\\\\\/strong>.<\\\\\\/p><p>Gracias a nuestro proceso de producci\\\\u00f3n propio, garantizamos un <strong>Palo Santo de calidad confiable<\\\\\\/strong>, listo para los mercados m\\\\u00e1s exigentes.<\\\\\\/p><p><strong>Nuestra Planta y Control de Calidad&nbsp;<\\\\\\/strong><\\\\\\/p><p>\\\\ud83d\\\\udfe9 Subt\\\\u00edtulo: Producci\\\\u00f3n propia, selecci\\\\u00f3n estricta y cumplimiento internacional&nbsp;<\\\\\\/p><p>Contamos con una planta de 1,000 m\\\\u00b2 ubicada en Per\\\\u00fa, recientemente inaugurada para centralizar nuestros procesos de selecci\\\\u00f3n, corte, secado y empaquetado de Palo Santo.&nbsp;<\\\\\\/p><p>Cada lote pasa por un riguroso sistema de control de calidad, que incluye:&nbsp;<\\\\\\/p><ul><li><p>Clasificaci\\\\u00f3n por calibre y humedad&nbsp;<\\\\\\/p><\\\\\\/li><li><p>Verificaci\\\\u00f3n visual manual&nbsp;<\\\\\\/p><\\\\\\/li><li><p>Trazabilidad desde el origen&nbsp;<\\\\\\/p><\\\\\\/li><li><p>Empaque final con condiciones \\\\u00f3ptimas para exportaci\\\\u00f3n&nbsp;<\\\\\\/p><\\\\\\/li><\\\\\\/ul><p>Gracias a este control interno, garantizamos una calidad estable por lote y el cumplimiento de los requisitos internacionales.<\\\\\\/p>\\\",\\\"mission\\\":\\\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\\\\\/p>\\\",\\\"vision\\\":\\\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\\\\\/p>\\\"},\\\"first_image\\\":\\\"uploads\\\\\\/about\\\\\\/2mwj9x1CJjsLMcCqm0Ct7K6g4ED6NoveB6MoZacs.webp\\\",\\\"second_image\\\":\\\"uploads\\\\\\/about\\\\\\/Ya4uGvmwZroT1kFoWvIFySMOwwwykkqLYAmvb2zd.webp\\\",\\\"youtube_video_id\\\":\\\"Dqn7FCXiQBk\\\"}\"}','{\"value\":\"{\\\"translations\\\":{\\\"history\\\":\\\"<p>Gate Export es una empresa peruana especializada en la <strong>exportaci\\\\u00f3n de Palo Santo y productos derivados de origen sustentable<\\\\\\/strong>.<\\\\\\/p><p>Con m\\\\u00e1s de 10 a\\\\u00f1os de experiencia, abastecemos a <strong>importadores y distribuidores en todos los continentes<\\\\\\/strong>, cumpliendo con los requisitos de calidad, consistencia por lote y normativa aduanera internacional.<\\\\\\/p><p>Nuestro enfoque est\\\\u00e1 orientado a <strong>facilitar la importaci\\\\u00f3n<\\\\\\/strong>, brindando <strong>soluciones personalizadas y soporte comercial constante<\\\\\\/strong>.<\\\\\\/p><p>Gracias a nuestro proceso de producci\\\\u00f3n propio, garantizamos un <strong>Palo Santo de calidad confiable<\\\\\\/strong>, listo para los mercados m\\\\u00e1s exigentes.<\\\\\\/p><p><strong>Nuestra Planta y Control de Calidad&nbsp;<\\\\\\/strong><\\\\\\/p><p>\\\\ud83d\\\\udfe9 Subt\\\\u00edtulo: Producci\\\\u00f3n propia, selecci\\\\u00f3n estricta y cumplimiento internacional&nbsp;<\\\\\\/p><p>Contamos con una planta de 1,000 m\\\\u00b2 ubicada en Per\\\\u00fa, recientemente inaugurada para centralizar nuestros procesos de selecci\\\\u00f3n, corte, secado y empaquetado de Palo Santo.&nbsp;<\\\\\\/p><p>Cada lote pasa por un riguroso sistema de control de calidad, que incluye:&nbsp;<\\\\\\/p><ul><li><p>Clasificaci\\\\u00f3n por calibre y humedad&nbsp;<\\\\\\/p><\\\\\\/li><li><p>Verificaci\\\\u00f3n visual manual&nbsp;<\\\\\\/p><\\\\\\/li><li><p>Trazabilidad desde el origen&nbsp;<\\\\\\/p><\\\\\\/li><li><p>Empaque final con condiciones \\\\u00f3ptimas para exportaci\\\\u00f3n&nbsp;<\\\\\\/p><\\\\\\/li><\\\\\\/ul><p>Gracias a este control interno, garantizamos una calidad estable por lote y el cumplimiento de los requisitos internacionales.<\\\\\\/p>\\\",\\\"mission\\\":\\\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\\\\\/p>\\\",\\\"vision\\\":\\\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\\\\\/p>\\\"},\\\"first_image\\\":\\\"uploads\\\\\\/about\\\\\\/Y46ktbpOQRBKBAikDwmVbCWt7viNSWe48vLngfDJ.webp\\\",\\\"second_image\\\":\\\"uploads\\\\\\/about\\\\\\/RUGLG65X9JrsK8QjuLQF6AiL6b5RTPIO48BflVzq.webp\\\",\\\"youtube_video_id\\\":\\\"Dqn7FCXiQBk\\\"}\"}','http://127.0.0.1:8000/livewire/update','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',NULL,'2025-08-01 03:39:38','2025-08-01 03:39:38'),(2,'App\\Models\\User',2,'updated','App\\Models\\Setting',10,'{\"value\":\"{\\\"translations\\\":{\\\"history\\\":\\\"<p>Gate Export es una empresa peruana especializada en la <strong>exportaci\\\\u00f3n de Palo Santo y productos derivados de origen sustentable<\\\\\\/strong>.<\\\\\\/p><p>Con m\\\\u00e1s de 10 a\\\\u00f1os de experiencia, abastecemos a <strong>importadores y distribuidores en todos los continentes<\\\\\\/strong>, cumpliendo con los requisitos de calidad, consistencia por lote y normativa aduanera internacional.<\\\\\\/p><p>Nuestro enfoque est\\\\u00e1 orientado a <strong>facilitar la importaci\\\\u00f3n<\\\\\\/strong>, brindando <strong>soluciones personalizadas y soporte comercial constante<\\\\\\/strong>.<\\\\\\/p><p>Gracias a nuestro proceso de producci\\\\u00f3n propio, garantizamos un <strong>Palo Santo de calidad confiable<\\\\\\/strong>, listo para los mercados m\\\\u00e1s exigentes.<\\\\\\/p><p><strong>Nuestra Planta y Control de Calidad&nbsp;<\\\\\\/strong><\\\\\\/p><p>\\\\ud83d\\\\udfe9 Subt\\\\u00edtulo: Producci\\\\u00f3n propia, selecci\\\\u00f3n estricta y cumplimiento internacional&nbsp;<\\\\\\/p><p>Contamos con una planta de 1,000 m\\\\u00b2 ubicada en Per\\\\u00fa, recientemente inaugurada para centralizar nuestros procesos de selecci\\\\u00f3n, corte, secado y empaquetado de Palo Santo.&nbsp;<\\\\\\/p><p>Cada lote pasa por un riguroso sistema de control de calidad, que incluye:&nbsp;<\\\\\\/p><ul><li><p>Clasificaci\\\\u00f3n por calibre y humedad&nbsp;<\\\\\\/p><\\\\\\/li><li><p>Verificaci\\\\u00f3n visual manual&nbsp;<\\\\\\/p><\\\\\\/li><li><p>Trazabilidad desde el origen&nbsp;<\\\\\\/p><\\\\\\/li><li><p>Empaque final con condiciones \\\\u00f3ptimas para exportaci\\\\u00f3n&nbsp;<\\\\\\/p><\\\\\\/li><\\\\\\/ul><p>Gracias a este control interno, garantizamos una calidad estable por lote y el cumplimiento de los requisitos internacionales.<\\\\\\/p>\\\",\\\"mission\\\":\\\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\\\\\/p>\\\",\\\"vision\\\":\\\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\\\\\/p>\\\"},\\\"first_image\\\":\\\"uploads\\\\\\/about\\\\\\/2mwj9x1CJjsLMcCqm0Ct7K6g4ED6NoveB6MoZacs.webp\\\",\\\"second_image\\\":\\\"uploads\\\\\\/about\\\\\\/Ya4uGvmwZroT1kFoWvIFySMOwwwykkqLYAmvb2zd.webp\\\",\\\"youtube_video_id\\\":\\\"Dqn7FCXiQBk\\\"}\"}','{\"value\":\"{\\\"translations\\\":{\\\"history\\\":\\\"<p>Gate Export es una empresa peruana especializada en la <strong>exportaci\\\\u00f3n de Palo Santo y productos derivados de origen sustentable<\\\\\\/strong>.<\\\\\\/p><p>Con m\\\\u00e1s de 10 a\\\\u00f1os de experiencia, abastecemos a <strong>importadores y distribuidores en todos los continentes<\\\\\\/strong>, cumpliendo con los requisitos de calidad, consistencia por lote y normativa aduanera internacional.<\\\\\\/p><p>Nuestro enfoque est\\\\u00e1 orientado a <strong>facilitar la importaci\\\\u00f3n<\\\\\\/strong>, brindando <strong>soluciones personalizadas y soporte comercial constante<\\\\\\/strong>.<\\\\\\/p><p>Gracias a nuestro proceso de producci\\\\u00f3n propio, garantizamos un <strong>Palo Santo de calidad confiable<\\\\\\/strong>, listo para los mercados m\\\\u00e1s exigentes.<\\\\\\/p><p><strong>Nuestra Planta y Control de Calidad&nbsp;<\\\\\\/strong><\\\\\\/p><p>\\\\ud83d\\\\udfe9 Subt\\\\u00edtulo: Producci\\\\u00f3n propia, selecci\\\\u00f3n estricta y cumplimiento internacional&nbsp;<\\\\\\/p><p>Contamos con una planta de 1,000 m\\\\u00b2 ubicada en Per\\\\u00fa, recientemente inaugurada para centralizar nuestros procesos de selecci\\\\u00f3n, corte, secado y empaquetado de Palo Santo.&nbsp;<\\\\\\/p><p>Cada lote pasa por un riguroso sistema de control de calidad, que incluye:&nbsp;<\\\\\\/p><ul><li><p>Clasificaci\\\\u00f3n por calibre y humedad&nbsp;<\\\\\\/p><\\\\\\/li><li><p>Verificaci\\\\u00f3n visual manual&nbsp;<\\\\\\/p><\\\\\\/li><li><p>Trazabilidad desde el origen&nbsp;<\\\\\\/p><\\\\\\/li><li><p>Empaque final con condiciones \\\\u00f3ptimas para exportaci\\\\u00f3n&nbsp;<\\\\\\/p><\\\\\\/li><\\\\\\/ul><p>Gracias a este control interno, garantizamos una calidad estable por lote y el cumplimiento de los requisitos internacionales.<\\\\\\/p>\\\",\\\"mission\\\":\\\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\\\\\/p>\\\",\\\"vision\\\":\\\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\\\\\/p>\\\"},\\\"first_image\\\":\\\"uploads\\\\\\/about\\\\\\/Y46ktbpOQRBKBAikDwmVbCWt7viNSWe48vLngfDJ.webp\\\",\\\"second_image\\\":\\\"uploads\\\\\\/about\\\\\\/RUGLG65X9JrsK8QjuLQF6AiL6b5RTPIO48BflVzq.webp\\\",\\\"youtube_video_id\\\":\\\"Dqn7FCXiQBk\\\"}\"}','http://127.0.0.1:8000/livewire/update','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',NULL,'2025-08-01 03:39:38','2025-08-01 03:39:38'),(3,'App\\Models\\User',2,'updated','App\\Models\\Setting',9,'{\"value\":\"{\\\"translations\\\":{\\\"history\\\":\\\"<p>Gate Export es una empresa peruana especializada en la <strong>exportaci\\\\u00f3n de Palo Santo y productos derivados de origen sustentable<\\\\\\/strong>.<\\\\\\/p><p>Con m\\\\u00e1s de 10 a\\\\u00f1os de experiencia, abastecemos a <strong>importadores y distribuidores en todos los continentes<\\\\\\/strong>, cumpliendo con los requisitos de calidad, consistencia por lote y normativa aduanera internacional.<\\\\\\/p><p>Nuestro enfoque est\\\\u00e1 orientado a <strong>facilitar la importaci\\\\u00f3n<\\\\\\/strong>, brindando <strong>soluciones personalizadas y soporte comercial constante<\\\\\\/strong>.<\\\\\\/p><p>Gracias a nuestro proceso de producci\\\\u00f3n propio, garantizamos un <strong>Palo Santo de calidad confiable<\\\\\\/strong>, listo para los mercados m\\\\u00e1s exigentes.<\\\\\\/p><p><strong>Nuestra Planta y Control de Calidad&nbsp;<\\\\\\/strong><\\\\\\/p><p>\\\\ud83d\\\\udfe9 Subt\\\\u00edtulo: Producci\\\\u00f3n propia, selecci\\\\u00f3n estricta y cumplimiento internacional&nbsp;<\\\\\\/p><p>Contamos con una planta de 1,000 m\\\\u00b2 ubicada en Per\\\\u00fa, recientemente inaugurada para centralizar nuestros procesos de selecci\\\\u00f3n, corte, secado y empaquetado de Palo Santo.&nbsp;<\\\\\\/p><p>Cada lote pasa por un riguroso sistema de control de calidad, que incluye:&nbsp;<\\\\\\/p><ul><li><p>Clasificaci\\\\u00f3n por calibre y humedad&nbsp;<\\\\\\/p><\\\\\\/li><li><p>Verificaci\\\\u00f3n visual manual&nbsp;<\\\\\\/p><\\\\\\/li><li><p>Trazabilidad desde el origen&nbsp;<\\\\\\/p><\\\\\\/li><li><p>Empaque final con condiciones \\\\u00f3ptimas para exportaci\\\\u00f3n&nbsp;<\\\\\\/p><\\\\\\/li><\\\\\\/ul><p>Gracias a este control interno, garantizamos una calidad estable por lote y el cumplimiento de los requisitos internacionales.<\\\\\\/p>\\\",\\\"mission\\\":\\\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\\\\\/p>\\\",\\\"vision\\\":\\\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\\\\\/p>\\\"},\\\"first_image\\\":\\\"uploads\\\\\\/about\\\\\\/Y46ktbpOQRBKBAikDwmVbCWt7viNSWe48vLngfDJ.webp\\\",\\\"second_image\\\":\\\"uploads\\\\\\/about\\\\\\/RUGLG65X9JrsK8QjuLQF6AiL6b5RTPIO48BflVzq.webp\\\",\\\"youtube_video_id\\\":\\\"Dqn7FCXiQBk\\\"}\"}','{\"value\":\"{\\\"translations\\\":{\\\"history\\\":\\\"<p>Somos exportadores directos de Palo Santo peruano, ofreciendo calidad consistente por lote y trazabilidad garantizada.<\\\\\\/p><p>Desde nuestro almac\\\\u00e9n propio de 1,000\\\\u202fm\\\\u00b2, procesamos y despachamos pedidos internacionales cumpliendo con las normativas aduaneras y fitosanitarias de Estados Unidos, Europa y Asia.<\\\\\\/p><p>Con m\\\\u00e1s de 10 a\\\\u00f1os de experiencia, ofrecemos empaques personalizados, pedidos m\\\\u00ednimos flexibles (MOQ) y una log\\\\u00edstica eficiente adaptada a importadores y distribuidores mayoristas a nivel mundial.<\\\\\\/p>\\\",\\\"mission\\\":\\\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\\\\\/p>\\\",\\\"vision\\\":\\\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\\\\\/p>\\\"},\\\"first_image\\\":\\\"uploads\\\\\\/about\\\\\\/Y46ktbpOQRBKBAikDwmVbCWt7viNSWe48vLngfDJ.webp\\\",\\\"second_image\\\":\\\"uploads\\\\\\/about\\\\\\/RUGLG65X9JrsK8QjuLQF6AiL6b5RTPIO48BflVzq.webp\\\",\\\"youtube_video_id\\\":\\\"Dqn7FCXiQBk\\\"}\"}','http://127.0.0.1:8000/livewire/update','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',NULL,'2025-08-01 03:41:46','2025-08-01 03:41:46'),(4,'App\\Models\\User',2,'updated','App\\Models\\Setting',10,'{\"value\":\"{\\\"translations\\\":{\\\"history\\\":\\\"<p>Gate Export es una empresa peruana especializada en la <strong>exportaci\\\\u00f3n de Palo Santo y productos derivados de origen sustentable<\\\\\\/strong>.<\\\\\\/p><p>Con m\\\\u00e1s de 10 a\\\\u00f1os de experiencia, abastecemos a <strong>importadores y distribuidores en todos los continentes<\\\\\\/strong>, cumpliendo con los requisitos de calidad, consistencia por lote y normativa aduanera internacional.<\\\\\\/p><p>Nuestro enfoque est\\\\u00e1 orientado a <strong>facilitar la importaci\\\\u00f3n<\\\\\\/strong>, brindando <strong>soluciones personalizadas y soporte comercial constante<\\\\\\/strong>.<\\\\\\/p><p>Gracias a nuestro proceso de producci\\\\u00f3n propio, garantizamos un <strong>Palo Santo de calidad confiable<\\\\\\/strong>, listo para los mercados m\\\\u00e1s exigentes.<\\\\\\/p><p><strong>Nuestra Planta y Control de Calidad&nbsp;<\\\\\\/strong><\\\\\\/p><p>\\\\ud83d\\\\udfe9 Subt\\\\u00edtulo: Producci\\\\u00f3n propia, selecci\\\\u00f3n estricta y cumplimiento internacional&nbsp;<\\\\\\/p><p>Contamos con una planta de 1,000 m\\\\u00b2 ubicada en Per\\\\u00fa, recientemente inaugurada para centralizar nuestros procesos de selecci\\\\u00f3n, corte, secado y empaquetado de Palo Santo.&nbsp;<\\\\\\/p><p>Cada lote pasa por un riguroso sistema de control de calidad, que incluye:&nbsp;<\\\\\\/p><ul><li><p>Clasificaci\\\\u00f3n por calibre y humedad&nbsp;<\\\\\\/p><\\\\\\/li><li><p>Verificaci\\\\u00f3n visual manual&nbsp;<\\\\\\/p><\\\\\\/li><li><p>Trazabilidad desde el origen&nbsp;<\\\\\\/p><\\\\\\/li><li><p>Empaque final con condiciones \\\\u00f3ptimas para exportaci\\\\u00f3n&nbsp;<\\\\\\/p><\\\\\\/li><\\\\\\/ul><p>Gracias a este control interno, garantizamos una calidad estable por lote y el cumplimiento de los requisitos internacionales.<\\\\\\/p>\\\",\\\"mission\\\":\\\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\\\\\/p>\\\",\\\"vision\\\":\\\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\\\\\/p>\\\"},\\\"first_image\\\":\\\"uploads\\\\\\/about\\\\\\/Y46ktbpOQRBKBAikDwmVbCWt7viNSWe48vLngfDJ.webp\\\",\\\"second_image\\\":\\\"uploads\\\\\\/about\\\\\\/RUGLG65X9JrsK8QjuLQF6AiL6b5RTPIO48BflVzq.webp\\\",\\\"youtube_video_id\\\":\\\"Dqn7FCXiQBk\\\"}\"}','{\"value\":\"{\\\"translations\\\":{\\\"history\\\":\\\"<p>We are direct exporters of Peruvian Palo Santo, offering batch-consistent quality and guaranteed traceability.<\\\\\\/p><p>From our 1,000\\\\u202fm\\\\u00b2 warehouse, we process and ship international orders in compliance with U.S., European, and Asian customs and phytosanitary regulations.<\\\\\\/p><p>With over 10 years of experience, we provide private-label packaging, flexible MOQs, and efficient logistics tailored to importers and wholesale distributors worldwide.<\\\\\\/p>\\\",\\\"mission\\\":\\\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\\\\\/p>\\\",\\\"vision\\\":\\\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\\\\\/p>\\\"},\\\"first_image\\\":\\\"uploads\\\\\\/about\\\\\\/Y46ktbpOQRBKBAikDwmVbCWt7viNSWe48vLngfDJ.webp\\\",\\\"second_image\\\":\\\"uploads\\\\\\/about\\\\\\/RUGLG65X9JrsK8QjuLQF6AiL6b5RTPIO48BflVzq.webp\\\",\\\"youtube_video_id\\\":\\\"Dqn7FCXiQBk\\\"}\"}','http://127.0.0.1:8000/livewire/update','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',NULL,'2025-08-01 03:41:46','2025-08-01 03:41:46'),(5,'App\\Models\\User',2,'updated','App\\Models\\Setting',7,'{\"value\":\"[{\\\"title\\\":\\\"Consistencia por lote\\\",\\\"description\\\":\\\"<p>Garantizamos la misma calidad en cada pedido, cumpliendo con las especificaciones que el importador necesita.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/yC2RbNCsj31bzqMO7g9gZmTSf3H0uSMnjw6pQi9o.png\\\"},{\\\"title\\\":\\\"Cumplimiento de est\\\\u00e1ndares internacionales\\\",\\\"description\\\":\\\"<p>Cumplimos con los requisitos aduaneros y sanitarios de cada mercado, asegurando que tu importaci\\\\u00f3n sea \\\\u00e1gil y confiable.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/lXqikOyrbOjF68Tp547PMJm5aiwsa5XMgK4cH4pD.png\\\"},{\\\"title\\\":\\\"Flexibilidad y empaques personalizados\\\",\\\"description\\\":\\\"<p>Nos adaptamos a las necesidades de cada importador, ofreciendo presentaciones y empaques a medida.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/brrCy6cXRq46Cd0YMLsYdP9wCs2itctpvuyGgnGx.png\\\"},{\\\"title\\\":\\\"Experiencia exportadora\\\",\\\"description\\\":\\\"<p>M\\\\u00e1s de 10 a\\\\u00f1os exportando Palo Santo a +25 pa\\\\u00edses, con conocimiento experto en procesos log\\\\u00edsticos y documentaci\\\\u00f3n.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/ZXYoW4WozM13pkld8Aod9mmp68fwMVljLMjdKTxF.png\\\"}]\"}','{\"value\":\"[{\\\"title\\\":\\\"Consistencia por lote\\\",\\\"description\\\":\\\"<p>Garantizamos la misma calidad en cada pedido, cumpliendo con las especificaciones que el importador necesita.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/yC2RbNCsj31bzqMO7g9gZmTSf3H0uSMnjw6pQi9o.png\\\"},{\\\"title\\\":\\\"Cumplimiento de est\\\\u00e1ndares internacionales\\\",\\\"description\\\":\\\"<p>Cumplimos con los requisitos aduaneros y sanitarios de cada mercado, asegurando que tu importaci\\\\u00f3n sea \\\\u00e1gil y confiable.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/lXqikOyrbOjF68Tp547PMJm5aiwsa5XMgK4cH4pD.png\\\"},{\\\"title\\\":\\\"Flexibilidad y empaques personalizados\\\",\\\"description\\\":\\\"<p>Nos adaptamos a las necesidades de cada importador, ofreciendo presentaciones y empaques a medida.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/brrCy6cXRq46Cd0YMLsYdP9wCs2itctpvuyGgnGx.png\\\"},{\\\"title\\\":\\\"Experiencia exportadora\\\",\\\"description\\\":\\\"<p>M\\\\u00e1s de 10 a\\\\u00f1os exportando Palo Santo a +25 pa\\\\u00edses, con conocimiento experto en procesos log\\\\u00edsticos y documentaci\\\\u00f3n.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/ZXYoW4WozM13pkld8Aod9mmp68fwMVljLMjdKTxF.png\\\"},{\\\"title\\\":\\\"Atenci\\\\u00f3n personalizada y r\\\\u00e1pida\\\",\\\"description\\\":\\\"<p>Priorizamos la comunicaci\\\\u00f3n efectiva y las soluciones r\\\\u00e1pidas para tus solicitudes y pedidos.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/sZyeHh6PE6ev3S6XuHPos3uciEJq8zwzXz5KpAUo.png\\\"}]\"}','http://127.0.0.1:8000/livewire/update','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',NULL,'2025-08-01 03:44:20','2025-08-01 03:44:20'),(6,'App\\Models\\User',2,'updated','App\\Models\\Setting',8,'{\"value\":\"[{\\\"title\\\":\\\"Batch Consistency\\\",\\\"description\\\":\\\"<p>We ensure the same quality in every order, meeting the specifications required by importers.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/z6NW02S9KH3i2hrtsrwSZMbToyiyGQCPP9rixuvl.png\\\"},{\\\"title\\\":\\\"Compliance with International Standards\\\",\\\"description\\\":\\\"<p>We meet customs and sanitary requirements in each market, ensuring smooth and reliable importation.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/vXd0LIBxVcz481Z88bCjMbaVK1uRuzimsXtsm5EB.png\\\"},{\\\"title\\\":\\\"Flexibility and Custom Packaging\\\",\\\"description\\\":\\\"<p>We adapt to each importer\\\\u2019s needs, offering tailored presentations and packaging.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/JzrHVMsySzstKmdYVdom0Ide383VPq1SiBOwiyh8.png\\\"},{\\\"title\\\":\\\"Export Experience\\\",\\\"description\\\":\\\"<p>Over 10 years exporting Palo Santo to more than 25 countries, with expert knowledge in logistics and documentation.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/dmXUmR0ma3ZPR6tfnDC0LFIQpM7wnQvbzLO2V1Tl.png\\\"}]\"}','{\"value\":\"[{\\\"title\\\":\\\"Batch Consistency\\\",\\\"description\\\":\\\"<p>We ensure the same quality in every order, meeting the specifications required by importers.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/z6NW02S9KH3i2hrtsrwSZMbToyiyGQCPP9rixuvl.png\\\"},{\\\"title\\\":\\\"Compliance with International Standards\\\",\\\"description\\\":\\\"<p>We meet customs and sanitary requirements in each market, ensuring smooth and reliable importation.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/vXd0LIBxVcz481Z88bCjMbaVK1uRuzimsXtsm5EB.png\\\"},{\\\"title\\\":\\\"Flexibility and Custom Packaging\\\",\\\"description\\\":\\\"<p>We adapt to each importer\\\\u2019s needs, offering tailored presentations and packaging.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/JzrHVMsySzstKmdYVdom0Ide383VPq1SiBOwiyh8.png\\\"},{\\\"title\\\":\\\"Export Experience\\\",\\\"description\\\":\\\"<p>Over 10 years exporting Palo Santo to more than 25 countries, with expert knowledge in logistics and documentation.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/dmXUmR0ma3ZPR6tfnDC0LFIQpM7wnQvbzLO2V1Tl.png\\\"},{\\\"title\\\":\\\"Personalized and Prompt Service\\\",\\\"description\\\":\\\"<p>We prioritize effective communication and quick solutions to your requests and orders.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/mQzrBEKmIUCvCXX9uIxBc0H4pYPNUggSFz3a7FhE.png\\\"}]\"}','http://127.0.0.1:8000/livewire/update','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',NULL,'2025-08-01 03:44:20','2025-08-01 03:44:20'),(7,'App\\Models\\User',2,'updated','App\\Models\\Setting',7,'{\"value\":\"[{\\\"title\\\":\\\"Consistencia por lote\\\",\\\"description\\\":\\\"<p>Garantizamos la misma calidad en cada pedido, cumpliendo con las especificaciones que el importador necesita.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/yC2RbNCsj31bzqMO7g9gZmTSf3H0uSMnjw6pQi9o.png\\\"},{\\\"title\\\":\\\"Cumplimiento de est\\\\u00e1ndares internacionales\\\",\\\"description\\\":\\\"<p>Cumplimos con los requisitos aduaneros y sanitarios de cada mercado, asegurando que tu importaci\\\\u00f3n sea \\\\u00e1gil y confiable.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/lXqikOyrbOjF68Tp547PMJm5aiwsa5XMgK4cH4pD.png\\\"},{\\\"title\\\":\\\"Flexibilidad y empaques personalizados\\\",\\\"description\\\":\\\"<p>Nos adaptamos a las necesidades de cada importador, ofreciendo presentaciones y empaques a medida.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/brrCy6cXRq46Cd0YMLsYdP9wCs2itctpvuyGgnGx.png\\\"},{\\\"title\\\":\\\"Experiencia exportadora\\\",\\\"description\\\":\\\"<p>M\\\\u00e1s de 10 a\\\\u00f1os exportando Palo Santo a +25 pa\\\\u00edses, con conocimiento experto en procesos log\\\\u00edsticos y documentaci\\\\u00f3n.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/ZXYoW4WozM13pkld8Aod9mmp68fwMVljLMjdKTxF.png\\\"},{\\\"title\\\":\\\"Atenci\\\\u00f3n personalizada y r\\\\u00e1pida\\\",\\\"description\\\":\\\"<p>Priorizamos la comunicaci\\\\u00f3n efectiva y las soluciones r\\\\u00e1pidas para tus solicitudes y pedidos.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/sZyeHh6PE6ev3S6XuHPos3uciEJq8zwzXz5KpAUo.png\\\"}]\"}','{\"value\":\"[{\\\"title\\\":\\\"Consistencia por lote\\\",\\\"description\\\":\\\"<p>Garantizamos la misma calidad en cada pedido, cumpliendo con las especificaciones que el importador necesita.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/yC2RbNCsj31bzqMO7g9gZmTSf3H0uSMnjw6pQi9o.png\\\"},{\\\"title\\\":\\\"Cumplimiento de est\\\\u00e1ndares internacionales\\\",\\\"description\\\":\\\"<p>Cumplimos con los requisitos aduaneros y sanitarios de cada mercado, asegurando que tu importaci\\\\u00f3n sea \\\\u00e1gil y confiable.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/lXqikOyrbOjF68Tp547PMJm5aiwsa5XMgK4cH4pD.png\\\"},{\\\"title\\\":\\\"Flexibilidad y empaques personalizados\\\",\\\"description\\\":\\\"<p>Nos adaptamos a las necesidades de cada importador, ofreciendo presentaciones y empaques a medida.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/brrCy6cXRq46Cd0YMLsYdP9wCs2itctpvuyGgnGx.png\\\"},{\\\"title\\\":\\\"Experiencia exportadora\\\",\\\"description\\\":\\\"<p>M\\\\u00e1s de 10 a\\\\u00f1os exportando Palo Santo a +25 pa\\\\u00edses, con conocimiento experto en procesos log\\\\u00edsticos y documentaci\\\\u00f3n.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/ZXYoW4WozM13pkld8Aod9mmp68fwMVljLMjdKTxF.png\\\"},{\\\"title\\\":\\\"Atenci\\\\u00f3n personalizada y r\\\\u00e1pida\\\",\\\"description\\\":\\\"<p>Priorizamos la comunicaci\\\\u00f3n efectiva y las soluciones r\\\\u00e1pidas para tus solicitudes y pedidos.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/XurZDmJsJbMJK37mHXujYLtGfpKKwVtW2HjXh2vf.png\\\"}]\"}','http://127.0.0.1:8000/livewire/update','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',NULL,'2025-08-01 03:52:34','2025-08-01 03:52:34'),(8,'App\\Models\\User',2,'updated','App\\Models\\Setting',8,'{\"value\":\"[{\\\"title\\\":\\\"Batch Consistency\\\",\\\"description\\\":\\\"<p>We ensure the same quality in every order, meeting the specifications required by importers.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/z6NW02S9KH3i2hrtsrwSZMbToyiyGQCPP9rixuvl.png\\\"},{\\\"title\\\":\\\"Compliance with International Standards\\\",\\\"description\\\":\\\"<p>We meet customs and sanitary requirements in each market, ensuring smooth and reliable importation.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/vXd0LIBxVcz481Z88bCjMbaVK1uRuzimsXtsm5EB.png\\\"},{\\\"title\\\":\\\"Flexibility and Custom Packaging\\\",\\\"description\\\":\\\"<p>We adapt to each importer\\\\u2019s needs, offering tailored presentations and packaging.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/JzrHVMsySzstKmdYVdom0Ide383VPq1SiBOwiyh8.png\\\"},{\\\"title\\\":\\\"Export Experience\\\",\\\"description\\\":\\\"<p>Over 10 years exporting Palo Santo to more than 25 countries, with expert knowledge in logistics and documentation.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/dmXUmR0ma3ZPR6tfnDC0LFIQpM7wnQvbzLO2V1Tl.png\\\"},{\\\"title\\\":\\\"Personalized and Prompt Service\\\",\\\"description\\\":\\\"<p>We prioritize effective communication and quick solutions to your requests and orders.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/mQzrBEKmIUCvCXX9uIxBc0H4pYPNUggSFz3a7FhE.png\\\"}]\"}','{\"value\":\"[{\\\"title\\\":\\\"Batch Consistency\\\",\\\"description\\\":\\\"<p>We ensure the same quality in every order, meeting the specifications required by importers.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/awUV8xfGr7N5ewY36f5tshN5sGpXHlCUzzNo96nY.webp\\\"},{\\\"title\\\":\\\"Compliance with International Standards\\\",\\\"description\\\":\\\"<p>We meet customs and sanitary requirements in each market, ensuring smooth and reliable importation.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/RcC1BreeqC15U0q6uFSuMj5YHOPid7PHnOp2orvH.webp\\\"},{\\\"title\\\":\\\"Flexibility and Custom Packaging\\\",\\\"description\\\":\\\"<p>We adapt to each importer\\\\u2019s needs, offering tailored presentations and packaging.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/QRaYMhbgdFu5mrxEK6JhQg1CkmBV2Lvt90lRJeH5.webp\\\"},{\\\"title\\\":\\\"Export Experience\\\",\\\"description\\\":\\\"<p>Over 10 years exporting Palo Santo to more than 25 countries, with expert knowledge in logistics and documentation.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/4GiTm1Fz8ZqdB1jCtTmYkCEtKLnVQPJqJizbX9VV.webp\\\"},{\\\"title\\\":\\\"Personalized and Prompt Service\\\",\\\"description\\\":\\\"<p>We prioritize effective communication and quick solutions to your requests and orders.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/Zr4yrk7KlTH81kf3spfF4SpdzWTXDjdoaPL426Ai.png\\\"}]\"}','http://127.0.0.1:8000/livewire/update','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',NULL,'2025-08-01 03:52:34','2025-08-01 03:52:34'),(9,'App\\Models\\User',2,'updated','App\\Models\\Setting',8,'{\"value\":\"[{\\\"title\\\":\\\"Batch Consistency\\\",\\\"description\\\":\\\"<p>We ensure the same quality in every order, meeting the specifications required by importers.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/awUV8xfGr7N5ewY36f5tshN5sGpXHlCUzzNo96nY.webp\\\"},{\\\"title\\\":\\\"Compliance with International Standards\\\",\\\"description\\\":\\\"<p>We meet customs and sanitary requirements in each market, ensuring smooth and reliable importation.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/RcC1BreeqC15U0q6uFSuMj5YHOPid7PHnOp2orvH.webp\\\"},{\\\"title\\\":\\\"Flexibility and Custom Packaging\\\",\\\"description\\\":\\\"<p>We adapt to each importer\\\\u2019s needs, offering tailored presentations and packaging.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/QRaYMhbgdFu5mrxEK6JhQg1CkmBV2Lvt90lRJeH5.webp\\\"},{\\\"title\\\":\\\"Export Experience\\\",\\\"description\\\":\\\"<p>Over 10 years exporting Palo Santo to more than 25 countries, with expert knowledge in logistics and documentation.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/4GiTm1Fz8ZqdB1jCtTmYkCEtKLnVQPJqJizbX9VV.webp\\\"},{\\\"title\\\":\\\"Personalized and Prompt Service\\\",\\\"description\\\":\\\"<p>We prioritize effective communication and quick solutions to your requests and orders.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/Zr4yrk7KlTH81kf3spfF4SpdzWTXDjdoaPL426Ai.png\\\"}]\"}','{\"value\":\"[{\\\"title\\\":\\\"Batch Consistency\\\",\\\"description\\\":\\\"<p>We ensure the same quality in every order, meeting the specifications required by importers.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/awUV8xfGr7N5ewY36f5tshN5sGpXHlCUzzNo96nY.webp\\\"},{\\\"title\\\":\\\"Compliance with International Standards\\\",\\\"description\\\":\\\"<p>We meet customs and sanitary requirements in each market, ensuring smooth and reliable importation.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/RcC1BreeqC15U0q6uFSuMj5YHOPid7PHnOp2orvH.webp\\\"},{\\\"title\\\":\\\"Flexibility and Custom Packaging\\\",\\\"description\\\":\\\"<p>We adapt to each importer\\\\u2019s needs, offering tailored presentations and packaging.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/QRaYMhbgdFu5mrxEK6JhQg1CkmBV2Lvt90lRJeH5.webp\\\"},{\\\"title\\\":\\\"Export Experience\\\",\\\"description\\\":\\\"<p>Over 10 years exporting Palo Santo to more than 25 countries, with expert knowledge in logistics and documentation.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/4GiTm1Fz8ZqdB1jCtTmYkCEtKLnVQPJqJizbX9VV.webp\\\"},{\\\"title\\\":\\\"Personalized and Prompt Service\\\",\\\"description\\\":\\\"<p>We prioritize effective communication and quick solutions to your requests and orders.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/7RoDxd2ERNpReHl2v9rUIh6PxyYCihBS1WdJH4Fe.webp\\\"}]\"}','http://127.0.0.1:8000/livewire/update','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',NULL,'2025-08-01 03:52:48','2025-08-01 03:52:48'),(10,'App\\Models\\User',2,'updated','App\\Models\\Setting',7,'{\"value\":\"[{\\\"title\\\":\\\"Consistencia por lote\\\",\\\"description\\\":\\\"<p>Garantizamos la misma calidad en cada pedido, cumpliendo con las especificaciones que el importador necesita.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/yC2RbNCsj31bzqMO7g9gZmTSf3H0uSMnjw6pQi9o.png\\\"},{\\\"title\\\":\\\"Cumplimiento de est\\\\u00e1ndares internacionales\\\",\\\"description\\\":\\\"<p>Cumplimos con los requisitos aduaneros y sanitarios de cada mercado, asegurando que tu importaci\\\\u00f3n sea \\\\u00e1gil y confiable.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/lXqikOyrbOjF68Tp547PMJm5aiwsa5XMgK4cH4pD.png\\\"},{\\\"title\\\":\\\"Flexibilidad y empaques personalizados\\\",\\\"description\\\":\\\"<p>Nos adaptamos a las necesidades de cada importador, ofreciendo presentaciones y empaques a medida.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/brrCy6cXRq46Cd0YMLsYdP9wCs2itctpvuyGgnGx.png\\\"},{\\\"title\\\":\\\"Experiencia exportadora\\\",\\\"description\\\":\\\"<p>M\\\\u00e1s de 10 a\\\\u00f1os exportando Palo Santo a +25 pa\\\\u00edses, con conocimiento experto en procesos log\\\\u00edsticos y documentaci\\\\u00f3n.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/ZXYoW4WozM13pkld8Aod9mmp68fwMVljLMjdKTxF.png\\\"},{\\\"title\\\":\\\"Atenci\\\\u00f3n personalizada y r\\\\u00e1pida\\\",\\\"description\\\":\\\"<p>Priorizamos la comunicaci\\\\u00f3n efectiva y las soluciones r\\\\u00e1pidas para tus solicitudes y pedidos.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/XurZDmJsJbMJK37mHXujYLtGfpKKwVtW2HjXh2vf.png\\\"}]\"}','{\"value\":\"[{\\\"title\\\":\\\"Consistencia por lote\\\",\\\"description\\\":\\\"<p>Garantizamos la misma calidad en cada pedido, cumpliendo con las especificaciones que el importador necesita.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/MuWwUul905CyP0EIOOuaZnY7W1P6apy39oM6HuVR.webp\\\"},{\\\"title\\\":\\\"Cumplimiento de est\\\\u00e1ndares internacionales\\\",\\\"description\\\":\\\"<p>Cumplimos con los requisitos aduaneros y sanitarios de cada mercado, asegurando que tu importaci\\\\u00f3n sea \\\\u00e1gil y confiable.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/ORQt2Zjo3Zby3CJKANl0fyjUcxrHhrPyaYo6oqAR.webp\\\"},{\\\"title\\\":\\\"Flexibilidad y empaques personalizados\\\",\\\"description\\\":\\\"<p>Nos adaptamos a las necesidades de cada importador, ofreciendo presentaciones y empaques a medida.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/lfmX4HBzyv4PzXm7wJz7IG5pfGe1bJTJzgZI9AOe.webp\\\"},{\\\"title\\\":\\\"Experiencia exportadora\\\",\\\"description\\\":\\\"<p>M\\\\u00e1s de 10 a\\\\u00f1os exportando Palo Santo a +25 pa\\\\u00edses, con conocimiento experto en procesos log\\\\u00edsticos y documentaci\\\\u00f3n.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/FBeazglcXiZxuKL4GmMJCFX6CRpHqtTX0psVkB9z.webp\\\"},{\\\"title\\\":\\\"Atenci\\\\u00f3n personalizada y r\\\\u00e1pida\\\",\\\"description\\\":\\\"<p>Priorizamos la comunicaci\\\\u00f3n efectiva y las soluciones r\\\\u00e1pidas para tus solicitudes y pedidos.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/IW5GJau3tSP0C35kPH0ZxhMoxxObIVnb4sY9WiUc.webp\\\"}]\"}','http://127.0.0.1:8000/livewire/update','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',NULL,'2025-08-01 03:53:14','2025-08-01 03:53:14'),(11,'App\\Models\\User',2,'updated','App\\Models\\Setting',8,'{\"value\":\"[{\\\"title\\\":\\\"Batch Consistency\\\",\\\"description\\\":\\\"<p>We ensure the same quality in every order, meeting the specifications required by importers.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/awUV8xfGr7N5ewY36f5tshN5sGpXHlCUzzNo96nY.webp\\\"},{\\\"title\\\":\\\"Compliance with International Standards\\\",\\\"description\\\":\\\"<p>We meet customs and sanitary requirements in each market, ensuring smooth and reliable importation.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/RcC1BreeqC15U0q6uFSuMj5YHOPid7PHnOp2orvH.webp\\\"},{\\\"title\\\":\\\"Flexibility and Custom Packaging\\\",\\\"description\\\":\\\"<p>We adapt to each importer\\\\u2019s needs, offering tailored presentations and packaging.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/QRaYMhbgdFu5mrxEK6JhQg1CkmBV2Lvt90lRJeH5.webp\\\"},{\\\"title\\\":\\\"Export Experience\\\",\\\"description\\\":\\\"<p>Over 10 years exporting Palo Santo to more than 25 countries, with expert knowledge in logistics and documentation.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/4GiTm1Fz8ZqdB1jCtTmYkCEtKLnVQPJqJizbX9VV.webp\\\"},{\\\"title\\\":\\\"Personalized and Prompt Service\\\",\\\"description\\\":\\\"<p>We prioritize effective communication and quick solutions to your requests and orders.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/7RoDxd2ERNpReHl2v9rUIh6PxyYCihBS1WdJH4Fe.webp\\\"}]\"}','{\"value\":\"[{\\\"title\\\":\\\"Batch Consistency\\\",\\\"description\\\":\\\"<p>We ensure the same quality in every order, meeting the specifications required by importers.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/awUV8xfGr7N5ewY36f5tshN5sGpXHlCUzzNo96nY.webp\\\"},{\\\"title\\\":\\\"Compliance with International Standards\\\",\\\"description\\\":\\\"<p>We meet customs and sanitary requirements in each market, ensuring smooth and reliable importation.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/RcC1BreeqC15U0q6uFSuMj5YHOPid7PHnOp2orvH.webp\\\"},{\\\"title\\\":\\\"Flexibility and Custom Packaging\\\",\\\"description\\\":\\\"<p>We adapt to each importer\\\\u2019s needs, offering tailored presentations and packaging.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/QRaYMhbgdFu5mrxEK6JhQg1CkmBV2Lvt90lRJeH5.webp\\\"},{\\\"title\\\":\\\"Export Experience\\\",\\\"description\\\":\\\"<p>Over 10 years exporting Palo Santo to more than 25 countries, with expert knowledge in logistics and documentation.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/4GiTm1Fz8ZqdB1jCtTmYkCEtKLnVQPJqJizbX9VV.webp\\\"},{\\\"title\\\":\\\"Personalized and Prompt Service\\\",\\\"description\\\":\\\"<p>We prioritize effective communication and quick solutions to your requests and orders.<\\\\\\/p>\\\",\\\"image\\\":\\\"uploads\\\\\\/settings\\\\\\/competitive_advantages\\\\\\/bN0qOG4lYMWUYSPH0Sl0kDpgi4xhJeajl2yA7uiZ.webp\\\"}]\"}','http://127.0.0.1:8000/livewire/update','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',NULL,'2025-08-01 03:53:14','2025-08-01 03:53:14'),(12,'App\\Models\\User',2,'updated','App\\Models\\Setting',5,'{\"value\":\"{\\\"services\\\":[{\\\"title\\\":\\\"Nuestros Servicios para Importadores\\\",\\\"description\\\":\\\"<p>Ofrecemos servicios dise\\\\u00f1ados especialmente para <strong>importadores de Palo Santo<\\\\\\/strong>, con soluciones log\\\\u00edsticas, documentarias y comerciales adaptadas a cada mercado internacional. Nuestro objetivo es facilitar tu proceso de compra desde el primer contacto hasta la entrega final, con calidad, rapidez y soporte profesional.<\\\\\\/p>\\\"},{\\\"title\\\":\\\"Control de calidad y consistencia por lote\\\",\\\"description\\\":\\\"<p>Aseguramos que cada lote mantenga est\\\\u00e1ndares constantes en corte, aroma y presentaci\\\\u00f3n, cumpliendo con lo que el importador espera recibir.<\\\\\\/p>\\\"},{\\\"title\\\":\\\"Coordinaci\\\\u00f3n log\\\\u00edstica a\\\\u00e9rea y mar\\\\u00edtima\\\",\\\"description\\\":\\\"<p>Coordinamos env\\\\u00edos internacionales por carga a\\\\u00e9rea o mar\\\\u00edtima, documentaci\\\\u00f3n completa y seguimiento constante hasta destino.<br><br><a target=\\\\\\\"_blank\\\\\\\" rel=\\\\\\\"noopener noreferrer nofollow\\\\\\\" href=\\\\\\\"https:\\\\\\/\\\\\\/google.com\\\\\\\"><strong>Solicita cotizaci\\\\u00f3n log\\\\u00edstica<\\\\\\/strong><\\\\\\/a><\\\\\\/p>\\\"},{\\\"title\\\":\\\"Control de calidad\\\",\\\"description\\\":\\\"<p>Ofrecemos servicios dise\\\\u00f1ados especialmente para <strong>importadores de Palo Santo<\\\\\\/strong>, con soluciones log\\\\u00edsticas, documentarias y comerciales adaptadas a cada mercado internacional. Nuestro objetivo es facilitar tu proceso de compra desde el primer contacto hasta la entrega final, con calidad, rapidez y soporte profesional.<\\\\\\/p>\\\"}],\\\"main_image\\\":\\\"uploads\\\\\\/settings\\\\\\/services\\\\\\/WstUZvyc4CVn0eJLtt4VKLAjNbQN0yLAF4SGqf1Y.webp\\\"}\"}','{\"value\":\"{\\\"services\\\":[{\\\"title\\\":\\\"Nuestros Servicios para Importadores\\\",\\\"description\\\":\\\"<p>Ofrecemos servicios dise\\\\u00f1ados especialmente para <strong>importadores de Palo Santo<\\\\\\/strong>, con soluciones log\\\\u00edsticas, documentarias y comerciales adaptadas a cada mercado internacional. Nuestro objetivo es facilitar tu proceso de compra desde el primer contacto hasta la entrega final, con calidad, rapidez y soporte profesional.<\\\\\\/p>\\\"},{\\\"title\\\":\\\"Control de calidad y consistencia por lote\\\",\\\"description\\\":\\\"<p>Aseguramos que cada lote mantenga est\\\\u00e1ndares constantes en corte, aroma y presentaci\\\\u00f3n, cumpliendo con lo que el importador espera recibir.<\\\\\\/p>\\\"},{\\\"title\\\":\\\"Coordinaci\\\\u00f3n log\\\\u00edstica a\\\\u00e9rea y mar\\\\u00edtima\\\",\\\"description\\\":\\\"<p>Coordinamos env\\\\u00edos internacionales por carga a\\\\u00e9rea o mar\\\\u00edtima, documentaci\\\\u00f3n completa y seguimiento constante hasta destino.<br><br><a target=\\\\\\\"_blank\\\\\\\" rel=\\\\\\\"noopener noreferrer nofollow\\\\\\\" href=\\\\\\\"https:\\\\\\/\\\\\\/google.com\\\\\\\"><strong>Solicita cotizaci\\\\u00f3n log\\\\u00edstica<\\\\\\/strong><\\\\\\/a><\\\\\\/p>\\\"},{\\\"title\\\":\\\"Control de calidad\\\",\\\"description\\\":\\\"<p>Ofrecemos servicios dise\\\\u00f1ados especialmente para <strong>importadores de Palo Santo<\\\\\\/strong>, con soluciones log\\\\u00edsticas, documentarias y comerciales adaptadas a cada mercado internacional. Nuestro objetivo es facilitar tu proceso de compra desde el primer contacto hasta la entrega final, con calidad, rapidez y soporte profesional.<\\\\\\/p>\\\"}],\\\"main_image\\\":\\\"uploads\\\\\\/settings\\\\\\/services\\\\\\/d0zwcIuuIG4BTOS6Tvdtw3p86jCWFEtMhD8sYfhQ.webp\\\"}\"}','http://127.0.0.1:8000/livewire/update','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',NULL,'2025-08-01 03:54:19','2025-08-01 03:54:19'),(13,'App\\Models\\User',2,'updated','App\\Models\\Setting',6,'{\"value\":\"{\\\"services\\\":[{\\\"title\\\":\\\"Our Services for B2B Palo Santo Importers\\\",\\\"description\\\":\\\"<p>We offer services specifically designed for B2B importers of Palo Santo, providing logistical, regulatory, and commercial solutions tailored to each international market. Our goal is to simplify your purchasing process, from first contact to final delivery, with quality, speed, and professional support.<\\\\\\/p>\\\"},{\\\"title\\\":\\\"Quality Control and Batch Consistency\\\",\\\"description\\\":\\\"<p>We ensure that every batch maintains consistent standards in cut, aroma, and presentation\\\\u2014delivering exactly what your business expects.<\\\\\\/p>\\\"},{\\\"title\\\":\\\"International Logistics Coordination\\\",\\\"description\\\":\\\"<p>We coordinate international shipments via air or ocean freight, providing full documentation and continuous tracking until delivery.<br><br><strong>Request a logistics quote<\\\\\\/strong><\\\\\\/p>\\\"}],\\\"main_image\\\":\\\"uploads\\\\\\/settings\\\\\\/services\\\\\\/WstUZvyc4CVn0eJLtt4VKLAjNbQN0yLAF4SGqf1Y.webp\\\"}\"}','{\"value\":\"{\\\"services\\\":[{\\\"title\\\":\\\"Our Services for B2B Palo Santo Importers\\\",\\\"description\\\":\\\"<p>We offer services specifically designed for B2B importers of Palo Santo, providing logistical, regulatory, and commercial solutions tailored to each international market. Our goal is to simplify your purchasing process, from first contact to final delivery, with quality, speed, and professional support.<\\\\\\/p>\\\"},{\\\"title\\\":\\\"Quality Control and Batch Consistency\\\",\\\"description\\\":\\\"<p>We ensure that every batch maintains consistent standards in cut, aroma, and presentation\\\\u2014delivering exactly what your business expects.<\\\\\\/p>\\\"},{\\\"title\\\":\\\"International Logistics Coordination\\\",\\\"description\\\":\\\"<p>We coordinate international shipments via air or ocean freight, providing full documentation and continuous tracking until delivery.<br><br><strong>Request a logistics quote<\\\\\\/strong><\\\\\\/p>\\\"}],\\\"main_image\\\":\\\"uploads\\\\\\/settings\\\\\\/services\\\\\\/d0zwcIuuIG4BTOS6Tvdtw3p86jCWFEtMhD8sYfhQ.webp\\\"}\"}','http://127.0.0.1:8000/livewire/update','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',NULL,'2025-08-01 03:54:19','2025-08-01 03:54:19');
/*!40000 ALTER TABLE `audits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('9cf1e2cf5757caef07aa9cbaa5f07c05','i:1;',1754001027),('9cf1e2cf5757caef07aa9cbaa5f07c05:timer','i:1754001027;',1754001027),('da4b9237bacccdf19c0760cab7aec4a8359010b0','i:1;',1754002515),('da4b9237bacccdf19c0760cab7aec4a8359010b0:timer','i:1754002515;',1754002515),('spatie.permission.cache','a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:14:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:10:\"view_users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:12:\"create_users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:12:\"update_users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:10:\"edit_users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:12:\"delete_users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"restore_users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:18:\"force_delete_users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:12:\"view_profile\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:13:\"view_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:15:\"create_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:15:\"update_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:15:\"delete_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:16:\"restore_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:21:\"force_delete_category\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"super_admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:4:\"user\";s:1:\"c\";s:3:\"web\";}}}',1753989293);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'{\"es\":\"Palo Santo\",\"en\":\"Palo Santo\"}','palo-santo','uploads/categories/GP8E6XDd3y2g6fpTY0TGRs3VfCDAjgBTICg79ETm.png','2025-07-31 01:15:21','2025-07-31 07:07:31'),(2,'{\"en\":\"Incense\",\"es\":\"Incienso\"}','incienso','uploads/categories/OM0MKTwFsz5Ojli4nWWZtycy7rx4kA42VJY1Zbt1.png','2025-07-31 02:11:40','2025-07-31 02:11:40'),(3,'{\"es\":\"Sahumerio\",\"en\":\"Sahumerio\"}','sahumerio','uploads/categories/gjhdmA2A3ZNuBtGgrAdidzik23HtDiHRjjPa9z1M.png','2025-07-31 06:30:25','2025-07-31 06:30:25');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_04_22_222934_create_profiles_table',1),(5,'2025_04_29_192117_add_two_factor_columns_to_users_table',1),(6,'2025_04_30_161817_create_permission_tables',1),(7,'2025_04_30_213819_create_audits_table',1),(8,'2025_05_01_030445_create_settings_table',1),(9,'2025_06_26_003853_create_categories_table',1),(10,'2025_06_26_004327_create_subcategories_table',1),(11,'2025_06_26_012853_create_products_table',1),(12,'2025_06_26_015011_create_product_images_table',1),(13,'2025_06_26_020431_create_product_specifications_table',1),(14,'2025_06_26_151258_create_orders_table',1),(15,'2025_06_26_153349_create_order_items_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',2);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` int(11) NOT NULL DEFAULT 0,
  `subtotal_price` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_number` varchar(255) NOT NULL,
  `customer_firstname` varchar(255) DEFAULT NULL,
  `customer_lastname` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('draft','sent','accepted','rejected','cancelled','completed') NOT NULL DEFAULT 'draft',
  `manager_id` bigint(20) unsigned DEFAULT NULL,
  `total_products` int(11) NOT NULL DEFAULT 0,
  `total_price` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_manager_id_foreign` (`manager_id`),
  CONSTRAINT `orders_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'view_users','web','2025-07-31 00:04:04','2025-07-31 00:04:04'),(2,'create_users','web','2025-07-31 00:04:04','2025-07-31 00:04:04'),(3,'update_users','web','2025-07-31 00:04:04','2025-07-31 00:04:04'),(4,'edit_users','web','2025-07-31 00:04:04','2025-07-31 00:04:04'),(5,'delete_users','web','2025-07-31 00:04:04','2025-07-31 00:04:04'),(6,'restore_users','web','2025-07-31 00:04:04','2025-07-31 00:04:04'),(7,'force_delete_users','web','2025-07-31 00:04:04','2025-07-31 00:04:04'),(8,'view_profile','web','2025-07-31 00:04:04','2025-07-31 00:04:04'),(9,'view_category','web','2025-07-31 00:04:04','2025-07-31 00:04:04'),(10,'create_category','web','2025-07-31 00:04:04','2025-07-31 00:04:04'),(11,'update_category','web','2025-07-31 00:04:04','2025-07-31 00:04:04'),(12,'delete_category','web','2025-07-31 00:04:04','2025-07-31 00:04:04'),(13,'restore_category','web','2025-07-31 00:04:04','2025-07-31 00:04:04'),(14,'force_delete_category','web','2025-07-31 00:04:04','2025-07-31 00:04:04');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `filename` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `mime_type` varchar(50) NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `width` smallint(5) unsigned NOT NULL DEFAULT 1000,
  `height` smallint(5) unsigned NOT NULL DEFAULT 1000,
  `order` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_order_index` (`product_id`,`order`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_specifications`
--

DROP TABLE IF EXISTS `product_specifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_specifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`key`)),
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`value`)),
  `product_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_specifications_product_id_foreign` (`product_id`),
  CONSTRAINT `product_specifications_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_specifications`
--

LOCK TABLES `product_specifications` WRITE;
/*!40000 ALTER TABLE `product_specifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_specifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `slug` varchar(255) NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description`)),
  `status` enum('published','draft') NOT NULL DEFAULT 'draft',
  `subcategory_id` bigint(20) unsigned DEFAULT NULL,
  `seo_title` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`seo_title`)),
  `seo_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`seo_description`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_subcategory_id_foreign` (`subcategory_id`),
  CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'{\"es\":\"Palo Santo Sticks\",\"en\":\"Palo Santo Sticks\"}','palo-santo-sticks','{\"es\":\"<p>Formato comercial de sticks de 10 cm de largo. <br>Seleccionados para exportaci\\u00f3n, corte uniforme, secado natural y calidad premium apta para exportaci\\u00f3n directa o marca privada. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>Stock disponible para carga a\\u00e9rea o mar\\u00edtima. MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Commercial format of 10 cm Palo Santo sticks. <br>Hand-selected for export, uniform cut, naturally dried, and premium quality suitable for direct export or private label. <br>Available in bulk or customized packaging. <br>Stock ready for air or sea shipment. Flexible MOQ depending on destination.<\\/p>\"}','published',1,'{\"es\":\"\",\"en\":\"\"}','{\"es\":\"\",\"en\":\"\"}','2025-07-31 08:05:03','2025-07-31 08:55:38'),(2,'{\"es\":\"Palo Santo Astillas\",\"en\":\"Palo Santo Splinter\"}','palo-santo-astillas','{\"es\":\"<p>Formato irregular de astillas de Palo Santo. <br>Producto recolectado de forma sostenible, secado natural. <br>Presentaci\\u00f3n a granel o en empaques personalizados <br>Stock disponible para exportaci\\u00f3n a\\u00e9rea o mar\\u00edtima. MOQ adaptable seg\\u00fan destino.<\\/p>\",\"en\":\"<p>Irregular-cut Palo Santo splinters. <br>Sustainably harvested and naturally dried. <br>Available in bulk or customized packaging. <br>Stock ready for air or sea export. MOQ adaptable to destination.<\\/p>\"}','published',2,'{\"es\":\"\",\"en\":\"\"}','{\"es\":\"\",\"en\":\"\"}','2025-07-31 08:57:15','2025-07-31 08:57:56'),(3,'{\"es\":\"Palo Santo Chips\",\"en\":\"Palo Santo Chips\"}','palo-santo-chips','{\"es\":\"<p>Trozos peque\\u00f1os de Palo Santo. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>Stock disponible para exportaci\\u00f3n a\\u00e9rea o mar\\u00edtima. <br>MOQ adaptable seg\\u00fan destino.<\\/p>\",\"en\":\"<p>Small pieces of Palo Santo. <br>Available in bulk or customized packaging. <br>Stock ready for air or sea export. MOQ adaptable to destination.<\\/p>\"}','published',3,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:15:13','2025-07-31 23:15:13'),(4,'{\"es\":\"Palo Santo Molido\",\"en\":\"Palo Santo Powder\"}','palo-santo-molido','{\"es\":\"<p>Formato molido fino de Palo Santo. <br>Apto para producci\\u00f3n de inciensos, c\\u00e1psulas o mezclas en polvo. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>Stock disponible para exportaci\\u00f3n a\\u00e9rea o mar\\u00edtima. <br>MOQ adaptable seg\\u00fan destino.<\\/p>\",\"en\":\"<p>Finely ground Palo Santo format. <br>Suitable for incense production, capsules, or powder blends. <br>Available in bulk or customized packaging. <br>Stock ready for air or sea export. MOQ adaptable to destination.<\\/p>\"}','published',4,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:16:10','2025-07-31 23:16:10'),(5,'{\"es\":\"Palo Santo Formato Natural\",\"en\":\"Palo Santo Natural Format\"}','palo-santo-formato-natural','{\"es\":\"<p>Fragmentos mixtos no clasificados de Palo Santo en formato natural. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>Stock disponible para exportaci\\u00f3n a\\u00e9rea o mar\\u00edtima. <br>MOQ adaptable seg\\u00fan destino.<\\/p>\",\"en\":\"<p>Mixed, unclassified Palo Santo fragments. Natural format. <br>Available in bulk or customized packaging. <br>Stock ready for air or sea export. MOQ adaptable to destination.<\\/p>\"}','published',5,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:16:57','2025-07-31 23:16:57'),(6,'{\"es\":\"Incienso De Palo Santo En Varilla\",\"en\":\"Palo Santo Stick Incense\"}','incienso-de-palo-santo-en-varilla','{\"es\":\"<p>Varilla de incienso artesanal de 23 cm, elaborada con polvo de Palo Santo natural. <br>Aroma intenso, combusti\\u00f3n lenta. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino. <br><\\/p>\",\"en\":\"<p>Handcrafted incense stick, 23 cm long, made with natural Palo Santo powder. <br>Strong aroma, slow-burning. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',6,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:17:37','2025-07-31 23:17:37'),(7,'{\"es\":\"Incienso De Palo Santo Y Copal En Varilla\",\"en\":\"Palo Santo & Copal Stick Incense\"}','incienso-de-palo-santo-y-copal-en-varilla','{\"es\":\"<p>Varilla de incienso artesanal de 23\\u202fcm, elaborada con polvo de Palo Santo natural y resina de copal. <br>Aroma intenso y resinoso. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted incense stick, 23\\u202fcm long, made with natural Palo Santo powder and copal resin. <br>Intense and resinous aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',6,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:18:15','2025-07-31 23:18:15'),(8,'{\"es\":\"Incienso De Palo Santo Y Mirra En Varilla\",\"en\":\"Palo Santo & Myrrh Stick Incense\"}','incienso-de-palo-santo-y-mirra-en-varilla','{\"es\":\"<p>Varilla de incienso artesanal de 23\\u202fcm, elaborada con polvo de Palo Santo natural y resina de mirra. <br>Aroma c\\u00e1lido y terroso, ideal para rituales y ambientes de calma. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted incense stick, 23\\u202fcm long, made with natural Palo Santo powder and myrrh resin. <br>Warm, earthy aroma ideal for rituals or calm environments. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',6,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:19:02','2025-07-31 23:19:02'),(9,'{\"es\":\"Incienso De Palo Santo Y Eucalipto En Varilla\",\"en\":\"Palo Santo & Eucalyptus Stick Incense\"}','incienso-de-palo-santo-y-eucalipto-en-varilla','{\"es\":\"<p>Varilla de incienso artesanal de 23 cm, elaborada con polvo de Palo Santo natural y hojas molidas de eucalipto. <br>Aroma refrescante y herbal. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted incense stick, 23 cm long, made with natural Palo Santo powder and ground eucalyptus leaves.<br>Refreshing and herbal aroma.<br>Available in bulk or customized packaging.<br>Flexible MOQ depending on destination.<\\/p>\"}','published',6,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:19:39','2025-07-31 23:19:39'),(10,'{\"es\":\"Incienso De Palo Santo Y Ruda En Varilla\",\"en\":\"Palo Santo & Rue Stick Incense\"}','incienso-de-palo-santo-y-ruda-en-varilla','{\"es\":\"<p>Varilla de incienso artesanal de 23 cm, elaborada con polvo de Palo Santo natural y hojas molidas de ruda. <br>Aroma intenso, tradicionalmente asociado a limpiezas energ\\u00e9ticas. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted incense stick, 23 cm long, made with natural Palo Santo powder and ground rue leaves. <br>Strong aroma, traditionally used for energetic cleansing. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',6,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:21:27','2025-07-31 23:21:27'),(11,'{\"es\":\"Incienso De Palo Santo Y Romero En Varilla\",\"en\":\"Palo Santo & Rosemary Stick Incense\"}','incienso-de-palo-santo-y-romero-en-varilla','{\"es\":\"<p>Varilla de incienso artesanal de 23 cm, elaborada con polvo de Palo Santo natural y hojas molidas de romero. <br>Aroma herbal y revitalizante. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted incense stick, 23 cm long, made with natural Palo Santo powder and ground rosemary leaves. <br>Herbal and revitalizing aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',6,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:23:06','2025-07-31 23:23:06'),(12,'{\"es\":\"Incienso De Palo Santo Y Jazm\\u00edn En Varilla\",\"en\":\"Palo Santo & Jasmine Stick Incense\"}','incienso-de-palo-santo-y-jazmin-en-varilla','{\"es\":\"<p>Varilla de incienso artesanal de 23 cm, elaborada con polvo de Palo Santo natural y esencia de jazm\\u00edn. <br>Aroma floral y delicado. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted incense stick, 23 cm long, made with natural Palo Santo powder and jasmine essence. <br>Floral, delicate and harmonizing aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',6,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:23:41','2025-07-31 23:23:41'),(13,'{\"es\":\"Incienso De Palo Santo Y Lavanda En Varilla\",\"en\":\"Palo Santo & Lavender Stick Incense\"}','incienso-de-palo-santo-y-lavanda-en-varilla','{\"es\":\"<p>Varilla de incienso artesanal de 23 cm, elaborada con polvo de Palo Santo natural y esencia de lavanda. <br>Aroma suave y relajante. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted incense stick, 23 cm long, made with natural Palo Santo powder and lavender essence. <br>Soft, relaxing and balancing aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',6,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:24:25','2025-07-31 23:24:25'),(14,'{\"es\":\"Incienso De Palo Santo Y Rosas En Varilla\",\"en\":\"Palo Santo & Rose Stick Incense\"}','incienso-de-palo-santo-y-rosas-en-varilla','{\"es\":\"<p>Varilla de incienso artesanal de 23 cm, elaborada con polvo de Palo Santo natural y esencia de rosas. <br>Aroma floral. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted incense stick, 23 cm long, made with natural Palo Santo powder and rose essence. <br>floral aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',6,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:24:57','2025-07-31 23:24:57'),(15,'{\"es\":\"Incienso De Palo Santo En Varilla\",\"en\":\"Palo Santo Incense Stick\"}','incienso-de-palo-santo-en-varilla-11-cm','{\"es\":\"<p>Varilla de incienso artesanal de 11 cm, elaborada con polvo de Palo Santo natural. <br>Aroma intenso, combusti\\u00f3n lenta. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted incense stick, 11 cm long, made with natural Palo Santo powder. <br>Strong aroma, slow-burning. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',7,'{\"es\":\"\",\"en\":\"\"}','{\"es\":\"\",\"en\":\"\"}','2025-07-31 23:26:00','2025-07-31 23:26:09'),(16,'{\"es\":\"Incienso De Palo Santo Y Copal En Varilla\",\"en\":\"Palo Santo & Copal Stick Incense\"}','incienso-de-palo-santo-y-copal-en-varilla-11-cm','{\"es\":\"<p>Varilla de incienso artesanal de 11\\u202fcm, elaborada con polvo de Palo Santo natural y resina de copal. <br>Aroma intenso, resinoso y envolvente. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted incense stick, 11 \\u202fcm long, made with natural Palo Santo powder and copal resin. <br>Intense, resinous and immersive aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',7,'{\"es\":\"\",\"en\":\"\"}','{\"es\":\"\",\"en\":\"\"}','2025-07-31 23:27:42','2025-07-31 23:27:47'),(17,'{\"es\":\"Incienso De Palo Santo Y Mirra En Varilla 11 Cm\",\"en\":\"Palo Santo & Myrrh Stick Incense\"}','incienso-de-palo-santo-y-mirra-en-varilla-11-cm','{\"es\":\"<p>Varilla de incienso artesanal de 23\\u202fcm, elaborada con polvo de Palo Santo natural y resina de mirra. <br>Aroma c\\u00e1lido y terroso, ideal para rituales y ambientes de calma. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted incense stick, 23\\u202fcm long, made with natural Palo Santo powder and myrrh resin. <br>Warm, earthy aroma ideal for rituals or calm environments. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',7,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:28:31','2025-07-31 23:28:31'),(18,'{\"es\":\"Incienso De Palo Santo Y Eucalipto En Varilla 11 Cm\",\"en\":\"Palo Santo & Eucalyptus Stick Incense\"}','incienso-de-palo-santo-y-eucalipto-en-varilla-11-cm','{\"es\":\"<p>Varilla de incienso artesanal de 11 cm, elaborada con polvo de Palo Santo natural y hojas molidas de eucalipto. <br>Aroma refrescante y herbal. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted incense stick, 11 cm long, made with natural Palo Santo powder and ground eucalyptus leaves. <br>Refreshing and herbal aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',7,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:29:59','2025-07-31 23:29:59'),(19,'{\"es\":\"Incienso De Palo Santo Y Ruda En Varilla 11 Cm\",\"en\":\"Palo Santo & Rue Stick Incense\"}','incienso-de-palo-santo-y-ruda-en-varilla-11-cm','{\"es\":\"<p>Varilla de incienso artesanal de 11 cm, elaborada con polvo de Palo Santo natural y hojas molidas de ruda. <br>Aroma intenso, tradicionalmente asociado a limpiezas energ\\u00e9ticas. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted incense stick, 11 cm long, made with natural Palo Santo powder and ground rue leaves. <br>Strong aroma, traditionally used for energetic cleansing. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',7,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:30:44','2025-07-31 23:30:44'),(20,'{\"es\":\"Incienso De Palo Santo Y Romero En Varilla 11 Cm\",\"en\":\"Palo Santo & Rosemary Stick Incense\"}','incienso-de-palo-santo-y-romero-en-varilla-11-cm','{\"es\":\"<p>Varilla de incienso artesanal de 11 cm, elaborada con polvo de Palo Santo natural y hojas molidas de romero. <br>Aroma herbal y revitalizante. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted incense stick, 11 cm long, made with natural Palo Santo powder and ground rosemary leaves. <br>Herbal and revitalizing aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',7,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:31:43','2025-07-31 23:31:43'),(21,'{\"es\":\"Incienso De Palo Santo Y Jazm\\u00edn En Varilla 11 Cm\",\"en\":\"Palo Santo & Jasmine Stick Incense\"}','incienso-de-palo-santo-y-jazmin-en-varilla-11-cm','{\"es\":\"<p>Varilla de incienso artesanal de 11 cm, elaborada con polvo de Palo Santo natural y esencia de jazm\\u00edn. <br>Aroma floral y delicado. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted incense stick, 11 cm long, made with natural Palo Santo powder and jasmine essence. <br>Floral, delicate and harmonizing aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',7,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:32:57','2025-07-31 23:32:57'),(22,'{\"es\":\"Incienso De Palo Santo Y Lavanda En Varilla 11 Cm\",\"en\":\"Palo Santo & Lavender Stick Incense\"}','incienso-de-palo-santo-y-lavanda-en-varilla-11-cm','{\"es\":\"<p>Varilla de incienso artesanal de 11 cm, elaborada con polvo de Palo Santo natural y esencia de lavanda. <br>Aroma suave y relajante. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted incense stick, 11 cm long, made with natural Palo Santo powder and lavender essence. <br>Soft, relaxing and balancing aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',7,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:33:47','2025-07-31 23:33:47'),(23,'{\"es\":\"Incienso De Palo Santo Y Rosas En Varilla 11 Cm\",\"en\":\"Palo Santo & Rose Stick Incense\"}','incienso-de-palo-santo-y-rosas-en-varilla-11-cm','{\"es\":\"<p>Varilla de incienso artesanal de 11 cm, elaborada con polvo de Palo Santo natural y esencia de rosas. <br>Aroma floral. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted incense stick, 11 cm long, made with natural Palo Santo powder and rose essence. <br>floral aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',7,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:35:04','2025-07-31 23:35:04'),(24,'{\"es\":\"Incienso De Palo Santo En Forma De Cono\",\"en\":\"Palo Santo Incense Cone\"}','incienso-de-palo-santo-en-forma-de-cono','{\"es\":\"<p>Cono de incienso artesanal de 4\\u00d72 cm aprox, elaborado con polvo de Palo Santo natural. <br>Aroma intenso, encendido pr\\u00e1ctico y combusti\\u00f3n controlada. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted cone-shaped incense made with Palo Santo powder, approx. 4 \\u00d7 2 cm. <br>Strong aroma, easy to light, with controlled burn. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',8,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:35:46','2025-07-31 23:35:46'),(25,'{\"es\":\"Incienso De Palo Santo Y Copal En Forma De Cono\",\"en\":\"Palo Santo & Copal Incense Cone\"}','incienso-de-palo-santo-y-copal-en-forma-de-cono','{\"es\":\"<p>Cono de incienso artesanal de 4\\u00d72 cm aprox, elaborado con polvo de Palo Santo natural y resina de copal. <br>Aroma intenso y resinoso. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted cone-shaped incense made with Palo Santo powder and copal resin, approx. 4 \\u00d7 2 cm. <br>Intense and resinous aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',8,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:36:42','2025-07-31 23:36:42'),(26,'{\"es\":\"Incienso De Palo Santo En Forma De Pir\\u00e1mide\",\"en\":\"Palo Santo Incense Pyramid\"}','incienso-de-palo-santo-en-forma-de-piramide','{\"es\":\"<p>incienso artesanal en forma de pir\\u00e1mide de 4\\u00d72 cm aprox, elaborado con polvo de Palo Santo natural. <br>Aroma intenso, encendido pr\\u00e1ctico y combusti\\u00f3n uniforme. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted pyramid-shaped incense made with Palo Santo powder, approx. 4 \\u00d7 2 cm. <br>Strong aroma, easy to light, even burning. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',9,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:37:31','2025-07-31 23:37:31'),(27,'{\"es\":\" Incienso De Palo Santo Y Copal En Forma De Pir\\u00e1mide\",\"en\":\"Palo Santo & Copal Incense Pyramid\"}','incienso-de-palo-santo-y-copal-en-forma-de-piramide','{\"es\":\"<p>incienso artesanal en forma de pir\\u00e1mide de 4\\u00d72 cm aprox, elaborado con polvo de Palo Santo natural y resina de copal. <br>Aroma intenso y resinoso. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted pyramid-shaped incense made with Palo Santo powder and copal resin, approx. 4 \\u00d7 2 cm. <br>Intense and resinous aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',9,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:38:24','2025-07-31 23:38:24'),(28,'{\"es\":\" Incienso De Palo Santo En Forma Rectangular\",\"en\":\"Rectangular Palo Santo Incense\"}','incienso-de-palo-santo-en-forma-rectangular','{\"es\":\"<p>incienso artesanal en formato rectangular de 10x1 cm aprox, elaborado con polvo de Palo Santo natural. <br>Aroma intenso, encendido pr\\u00e1ctico y combusti\\u00f3n uniforme. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted rectangular Palo Santo incense made with Palo Santo powder, approx. 10 \\u00d7 1 cm. <br>Strong aroma, easy to light, with uniform burn. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',10,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:39:12','2025-07-31 23:39:12'),(29,'{\"es\":\" Incienso De Palo Santo Y Copal En Forma De Rectangular\",\"en\":\"Rectangular Palo Santo & Copal Incense \"}','incienso-de-palo-santo-y-copal-en-forma-de-rectangular','{\"es\":\"<p>incienso artesanal en formato rectangular de 10x1 cm aprox, elaborado con polvo de Palo Santo natural y resina de copal. <br>Aroma intenso y resinoso. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Handcrafted rectangular Palo Santo incense made with Palo Santo powder and copal resin, approx. 10 \\u00d7 1 cm. <br>Intense and resinous aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',10,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:41:02','2025-07-31 23:41:02'),(30,'{\"es\":\"Sahumerio De Eucalipto Con Palo Santo En Manojo\",\"en\":\"Eucalyptus Smudge Bundle With Palo Santo\"}','sahumerio-de-eucalipto-con-palo-santo-en-manojo','{\"es\":\"<p>Sahumerio de 10 cm con hojas secas de eucalipto y un stick de Palo Santo natural. <br>Aroma herbal y amaderado. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Smudge bundle, approx. 10 cm, made with dried eucalyptus leaves and a natural Palo Santo stick. <br>Herbal and woody aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',11,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:43:51','2025-07-31 23:43:51'),(31,'{\"es\":\"Sahumerio De Ruda Con Palo Santo En Manojo\",\"en\":\"Rue Smudge Bundle With Palo Santo\"}','sahumerio-de-ruda-con-palo-santo-en-manojo','{\"es\":\"<p>Sahumerio de 10 cm con hojas secas de ruda y un stick de Palo Santo natural. <br>Aroma intenso y amaderado. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Smudge bundle, approx. 10 cm, made with dried rue leaves and a natural Palo Santo stick. <br>Strong and woody aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',11,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:45:48','2025-07-31 23:45:48'),(32,'{\"es\":\"Sahumerio De Romero Con Palo Santo En Manojo\",\"en\":\"Rosemary Smudge Bundle With Palo Santo\"}','sahumerio-de-romero-con-palo-santo-en-manojo','{\"es\":\"<p>Sahumerio de 10 cm con romero seco y un stick de Palo Santo natural. <br>Aroma herbal y amaderado. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Smudge bundle, approx. 10 cm, made with dried rosemary and a natural Palo Santo stick. <br>Herbal and woody aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',11,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:46:25','2025-07-31 23:46:25'),(33,'{\"es\":\"Sahumerio De Lavanda Con Palo Santo En Manojo\",\"en\":\"Lavender Smudge Bundle With Palo Santo\"}','sahumerio-de-lavanda-con-palo-santo-en-manojo','{\"es\":\"<p>Sahumerio de 10 cm con flores secas de lavanda y un stick de Palo Santo natural. <br>Aroma suave y amaderado. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Smudge bundle, approx. 10 cm, made with dried lavender flowers and a natural Palo Santo stick. <br>Soft and woody aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',11,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:47:06','2025-07-31 23:47:06'),(34,'{\"es\":\"Sahumerio De Salvia Con Palo Santo En Manojo\",\"en\":\"White Sage Smudge Bundle With Palo Santo\"}','sahumerio-de-salvia-con-palo-santo-en-manojo','{\"es\":\"<p>Sahumerio de 10 cm con hojas secas de salvia blanca y un stick de Palo Santo natural. <br>Aroma fuerte y amaderado. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Smudge bundle, approx. 10 cm, made with dried white sage and a natural Palo Santo stick. <br>Strong and woody aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',11,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:52:31','2025-07-31 23:52:31'),(35,'{\"es\":\"Sahumerio De Rosa Con Palo Santo En Manojo\",\"en\":\"Rose Smudge Bundle With Palo Santo\"}','sahumerio-de-rosa-con-palo-santo-en-manojo','{\"es\":\"<p>Sahumerio de 10 cm con p\\u00e9talos secos de rosa y un stick de Palo Santo natural. <br>Aroma floral y amaderado. <br>Presentaci\\u00f3n a granel o en empaques personalizados. <br>MOQ flexible seg\\u00fan pa\\u00eds de destino.<\\/p>\",\"en\":\"<p>Smudge bundle, approx. 10 cm, made with dried rose petals and a natural Palo Santo stick. <br>Floral and woody aroma. <br>Available in bulk or customized packaging. <br>Flexible MOQ depending on destination.<\\/p>\"}','published',11,'{\"es\":\"\",\"en\":\"\"}','{\"es\":null,\"en\":null}','2025-07-31 23:53:08','2025-07-31 23:53:08');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `profiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `document_type` enum('passport','ce','dni') NOT NULL DEFAULT 'dni',
  `document_number` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (1,2,'Admin','User',NULL,'dni',NULL,NULL,'2025-07-31 00:04:05','2025-07-31 00:04:05');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(8,2),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'super_admin','web','2025-07-31 00:04:04','2025-07-31 00:04:04'),(2,'user','web','2025-07-31 00:04:04','2025-07-31 00:04:04');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('M4Y2FFxRmbpatusHRJT33FJgKw5DONbssJbUi64C',2,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZDJXdHpSaFRJWDVHMnhTR3FNRVVXZHVROUlKdXBiM21oMWRJZmNvSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3Byb2R1Y3RzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czo2OiJsb2NhbGUiO3M6MjoiZXMiO30=',1754008122);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`value`)),
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `type` varchar(255) NOT NULL DEFAULT 'string',
  `is_public` tinyint(1) NOT NULL DEFAULT 0,
  `locale` varchar(255) NOT NULL DEFAULT 'es',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_locale_group_unique` (`key`,`locale`,`group`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'general_info','{\"translations\":{\"company_name\":\"Gate Export\",\"company_short_description\":\"En Gate Export, somos especialistas en la exportaci\\u00f3n de Palo Santo y productos derivados. Nacimos con la visi\\u00f3n de conectar la riqueza natural de nuestro pa\\u00eds con el mundo, convirti\\u00e9ndonos en el socio estrat\\u00e9gico de confianza para importadores internacionales.\",\"company_description\":\"<p>En Gate Export, somos especialistas en la exportaci\\u00f3n de Palo Santo y productos derivados. Nacimos con la visi\\u00f3n de conectar la riqueza natural de nuestro pa\\u00eds con el mundo, convirti\\u00e9ndonos en el socio estrat\\u00e9gico de confianza para importadores internacionales.<\\/p><p>Con m\\u00e1s de 10 a\\u00f1os de experiencia, hemos establecido relaciones s\\u00f3lidas con importadores y mayoristas en m\\u00e1s de 25 pa\\u00edses, entregando siempre productos de alta calidad y cumpliendo con los m\\u00e1s altos est\\u00e1ndares de exportaci\\u00f3n.<\\/p><p>Nuestra fortaleza radica en ofrecer Palo Santo con consistencia por lote, garantizando que cada pedido cumpla con las especificaciones de nuestros clientes y con los requisitos aduaneros y sanitarios de cada mercado. Nos adaptamos a las necesidades de importadores y mayoristas, ofreciendo empaques personalizados y soluciones log\\u00edsticas que facilitan el proceso de importaci\\u00f3n.<\\/p>\"},\"large_logo\":\"uploads\\/settings\\/logos\\/AgMPU8Ii4FwH5KM6ifMiw9AhkIewJAQVmaDMDa9X.jpg\",\"small_logo\":\"uploads\\/settings\\/logos\\/iEODcGIqKZfOIfOBlWmgPJTTD6AASSVGry68xOtX.jpg\",\"catalog_document\":\"uploads\\/docs\\/BBrZuphUjZVeyORTtxlfZkvYjMoFeSAp6hNbuRtQ.pdf\",\"social_media\":{\"facebook\":\"https:\\/\\/www.facebook.com\\/GateExport\",\"youtube\":\"https:\\/\\/www.youtube.com\\/channel\\/UCDRvKqepeavnqwbBaDNavPQ\",\"linkedin\":\"https:\\/\\/www.linkedin.com\\/company\\/gate-export-s-a-c\"},\"contact_information\":{\"address\":\"Mz J2 lote 24A Alameda Naranjal, Los Olivos, Per\\u00fa\",\"phone\":\"+51 957 301 782\",\"second_phone\":\"+51 952 386 349\",\"whatsapp_link\":\"https:\\/\\/api.whatsapp.com\\/send\\/?phone=51952375248\",\"email\":\"sales@gatexport.com\"}}','general','json',1,'es','2025-07-16 06:03:28','2025-07-20 22:35:55'),(2,'general_info','{\"translations\":{\"company_name\":\"Gate Export\",\"company_short_description\":\"At Gate Export, we specialize in the wholesale export of Palo Santo and its derivatives. We were born with the vision of connecting the natural richness of our country with the world, becoming a trusted strategic partner for international importers.\",\"company_description\":\"<p>At Gate Export, we specialize in the wholesale export of Palo Santo and its derivatives. We were born with the vision of connecting the natural richness of our country with the world, becoming a trusted strategic partner for international importers.<\\/p><p>With over 10 years of experience, we have established strong relationships with importers and wholesalers in more than 25 countries, consistently delivering high-quality products that meet the highest export standards.<\\/p><p>Our strength lies in providing Palo Santo with batch-to-batch consistency, ensuring that every shipment meets our clients\\u2019 specifications and complies with the customs and sanitary requirements of each market. We adapt to the needs of importers and wholesalers by offering customized packaging and logistical solutions that simplify the import process.<\\/p>\"},\"large_logo\":\"uploads\\/settings\\/logos\\/AgMPU8Ii4FwH5KM6ifMiw9AhkIewJAQVmaDMDa9X.jpg\",\"small_logo\":\"uploads\\/settings\\/logos\\/iEODcGIqKZfOIfOBlWmgPJTTD6AASSVGry68xOtX.jpg\",\"catalog_document\":\"uploads\\/docs\\/BBrZuphUjZVeyORTtxlfZkvYjMoFeSAp6hNbuRtQ.pdf\",\"social_media\":{\"facebook\":\"https:\\/\\/www.facebook.com\\/GateExport\",\"youtube\":\"https:\\/\\/www.youtube.com\\/channel\\/UCDRvKqepeavnqwbBaDNavPQ\",\"linkedin\":\"https:\\/\\/www.linkedin.com\\/company\\/gate-export-s-a-c\"},\"contact_information\":{\"address\":\"Mz J2 lote 24A Alameda Naranjal, Los Olivos, Per\\u00fa\",\"phone\":\"+51 957 301 782\",\"second_phone\":\"+51 952 386 349\",\"whatsapp_link\":\"https:\\/\\/api.whatsapp.com\\/send\\/?phone=51952375248\",\"email\":\"sales@gatexport.com\"}}','general','json',1,'en','2025-07-16 06:03:28','2025-07-20 22:35:55'),(3,'banners','[]','home','json',1,'es','2025-07-16 22:45:08','2025-07-19 06:29:35'),(4,'banners','[]','home','json',1,'en','2025-07-16 22:45:08','2025-07-19 06:29:35'),(5,'company_services','{\"services\":[{\"title\":\"Nuestros Servicios para Importadores\",\"description\":\"<p>Ofrecemos servicios dise\\u00f1ados especialmente para <strong>importadores de Palo Santo<\\/strong>, con soluciones log\\u00edsticas, documentarias y comerciales adaptadas a cada mercado internacional. Nuestro objetivo es facilitar tu proceso de compra desde el primer contacto hasta la entrega final, con calidad, rapidez y soporte profesional.<\\/p>\"},{\"title\":\"Control de calidad y consistencia por lote\",\"description\":\"<p>Aseguramos que cada lote mantenga est\\u00e1ndares constantes en corte, aroma y presentaci\\u00f3n, cumpliendo con lo que el importador espera recibir.<\\/p>\"},{\"title\":\"Coordinaci\\u00f3n log\\u00edstica a\\u00e9rea y mar\\u00edtima\",\"description\":\"<p>Coordinamos env\\u00edos internacionales por carga a\\u00e9rea o mar\\u00edtima, documentaci\\u00f3n completa y seguimiento constante hasta destino.<br><br><a target=\\\"_blank\\\" rel=\\\"noopener noreferrer nofollow\\\" href=\\\"https:\\/\\/google.com\\\"><strong>Solicita cotizaci\\u00f3n log\\u00edstica<\\/strong><\\/a><\\/p>\"},{\"title\":\"Control de calidad\",\"description\":\"<p>Ofrecemos servicios dise\\u00f1ados especialmente para <strong>importadores de Palo Santo<\\/strong>, con soluciones log\\u00edsticas, documentarias y comerciales adaptadas a cada mercado internacional. Nuestro objetivo es facilitar tu proceso de compra desde el primer contacto hasta la entrega final, con calidad, rapidez y soporte profesional.<\\/p>\"}],\"main_image\":\"uploads\\/settings\\/services\\/d0zwcIuuIG4BTOS6Tvdtw3p86jCWFEtMhD8sYfhQ.webp\"}','home','json',1,'es','2025-07-17 04:27:56','2025-08-01 03:54:19'),(6,'company_services','{\"services\":[{\"title\":\"Our Services for B2B Palo Santo Importers\",\"description\":\"<p>We offer services specifically designed for B2B importers of Palo Santo, providing logistical, regulatory, and commercial solutions tailored to each international market. Our goal is to simplify your purchasing process, from first contact to final delivery, with quality, speed, and professional support.<\\/p>\"},{\"title\":\"Quality Control and Batch Consistency\",\"description\":\"<p>We ensure that every batch maintains consistent standards in cut, aroma, and presentation\\u2014delivering exactly what your business expects.<\\/p>\"},{\"title\":\"International Logistics Coordination\",\"description\":\"<p>We coordinate international shipments via air or ocean freight, providing full documentation and continuous tracking until delivery.<br><br><strong>Request a logistics quote<\\/strong><\\/p>\"}],\"main_image\":\"uploads\\/settings\\/services\\/d0zwcIuuIG4BTOS6Tvdtw3p86jCWFEtMhD8sYfhQ.webp\"}','home','json',1,'en','2025-07-17 04:27:56','2025-08-01 03:54:19'),(7,'competitive_advantages','[{\"title\":\"Consistencia por lote\",\"description\":\"<p>Garantizamos la misma calidad en cada pedido, cumpliendo con las especificaciones que el importador necesita.<\\/p>\",\"image\":\"uploads\\/settings\\/competitive_advantages\\/MuWwUul905CyP0EIOOuaZnY7W1P6apy39oM6HuVR.webp\"},{\"title\":\"Cumplimiento de est\\u00e1ndares internacionales\",\"description\":\"<p>Cumplimos con los requisitos aduaneros y sanitarios de cada mercado, asegurando que tu importaci\\u00f3n sea \\u00e1gil y confiable.<\\/p>\",\"image\":\"uploads\\/settings\\/competitive_advantages\\/ORQt2Zjo3Zby3CJKANl0fyjUcxrHhrPyaYo6oqAR.webp\"},{\"title\":\"Flexibilidad y empaques personalizados\",\"description\":\"<p>Nos adaptamos a las necesidades de cada importador, ofreciendo presentaciones y empaques a medida.<\\/p>\",\"image\":\"uploads\\/settings\\/competitive_advantages\\/lfmX4HBzyv4PzXm7wJz7IG5pfGe1bJTJzgZI9AOe.webp\"},{\"title\":\"Experiencia exportadora\",\"description\":\"<p>M\\u00e1s de 10 a\\u00f1os exportando Palo Santo a +25 pa\\u00edses, con conocimiento experto en procesos log\\u00edsticos y documentaci\\u00f3n.<\\/p>\",\"image\":\"uploads\\/settings\\/competitive_advantages\\/FBeazglcXiZxuKL4GmMJCFX6CRpHqtTX0psVkB9z.webp\"},{\"title\":\"Atenci\\u00f3n personalizada y r\\u00e1pida\",\"description\":\"<p>Priorizamos la comunicaci\\u00f3n efectiva y las soluciones r\\u00e1pidas para tus solicitudes y pedidos.<\\/p>\",\"image\":\"uploads\\/settings\\/competitive_advantages\\/IW5GJau3tSP0C35kPH0ZxhMoxxObIVnb4sY9WiUc.webp\"}]','home','json',1,'es','2025-07-17 04:52:25','2025-08-01 03:53:14'),(8,'competitive_advantages','[{\"title\":\"Batch Consistency\",\"description\":\"<p>We ensure the same quality in every order, meeting the specifications required by importers.<\\/p>\",\"image\":\"uploads\\/settings\\/competitive_advantages\\/awUV8xfGr7N5ewY36f5tshN5sGpXHlCUzzNo96nY.webp\"},{\"title\":\"Compliance with International Standards\",\"description\":\"<p>We meet customs and sanitary requirements in each market, ensuring smooth and reliable importation.<\\/p>\",\"image\":\"uploads\\/settings\\/competitive_advantages\\/RcC1BreeqC15U0q6uFSuMj5YHOPid7PHnOp2orvH.webp\"},{\"title\":\"Flexibility and Custom Packaging\",\"description\":\"<p>We adapt to each importer\\u2019s needs, offering tailored presentations and packaging.<\\/p>\",\"image\":\"uploads\\/settings\\/competitive_advantages\\/QRaYMhbgdFu5mrxEK6JhQg1CkmBV2Lvt90lRJeH5.webp\"},{\"title\":\"Export Experience\",\"description\":\"<p>Over 10 years exporting Palo Santo to more than 25 countries, with expert knowledge in logistics and documentation.<\\/p>\",\"image\":\"uploads\\/settings\\/competitive_advantages\\/4GiTm1Fz8ZqdB1jCtTmYkCEtKLnVQPJqJizbX9VV.webp\"},{\"title\":\"Personalized and Prompt Service\",\"description\":\"<p>We prioritize effective communication and quick solutions to your requests and orders.<\\/p>\",\"image\":\"uploads\\/settings\\/competitive_advantages\\/bN0qOG4lYMWUYSPH0Sl0kDpgi4xhJeajl2yA7uiZ.webp\"}]','home','json',1,'en','2025-07-17 04:52:25','2025-08-01 03:53:14'),(9,'about','{\"translations\":{\"history\":\"<p>Somos exportadores directos de Palo Santo peruano, ofreciendo calidad consistente por lote y trazabilidad garantizada.<\\/p><p>Desde nuestro almac\\u00e9n propio de 1,000\\u202fm\\u00b2, procesamos y despachamos pedidos internacionales cumpliendo con las normativas aduaneras y fitosanitarias de Estados Unidos, Europa y Asia.<\\/p><p>Con m\\u00e1s de 10 a\\u00f1os de experiencia, ofrecemos empaques personalizados, pedidos m\\u00ednimos flexibles (MOQ) y una log\\u00edstica eficiente adaptada a importadores y distribuidores mayoristas a nivel mundial.<\\/p>\",\"mission\":\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\/p>\",\"vision\":\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\/p>\"},\"first_image\":\"uploads\\/about\\/Y46ktbpOQRBKBAikDwmVbCWt7viNSWe48vLngfDJ.webp\",\"second_image\":\"uploads\\/about\\/RUGLG65X9JrsK8QjuLQF6AiL6b5RTPIO48BflVzq.webp\",\"youtube_video_id\":\"Dqn7FCXiQBk\"}','about','json',1,'es','2025-07-17 05:57:48','2025-08-01 03:41:46'),(10,'about','{\"translations\":{\"history\":\"<p>We are direct exporters of Peruvian Palo Santo, offering batch-consistent quality and guaranteed traceability.<\\/p><p>From our 1,000\\u202fm\\u00b2 warehouse, we process and ship international orders in compliance with U.S., European, and Asian customs and phytosanitary regulations.<\\/p><p>With over 10 years of experience, we provide private-label packaging, flexible MOQs, and efficient logistics tailored to importers and wholesale distributors worldwide.<\\/p>\",\"mission\":\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\/p>\",\"vision\":\"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum efficitur metus a congue imperdiet. Nullam at eros at augue placerat consequat. Ut efficitur ornare leo, sit amet luctus lacus fringilla ac. Phasellus lobortis sapien ut augue bibendum, non venenatis tellus tincidunt. Sed a elementum eros. Nunc accumsan dolor sit amet velit ultrices sagittis. Aliquam erat volutpat. In sed risus eu sem efficitur ultrices et et lorem. Aenean laoreet felis tincidunt facilisis euismod. Aliquam erat volutpat.<\\/p>\"},\"first_image\":\"uploads\\/about\\/Y46ktbpOQRBKBAikDwmVbCWt7viNSWe48vLngfDJ.webp\",\"second_image\":\"uploads\\/about\\/RUGLG65X9JrsK8QjuLQF6AiL6b5RTPIO48BflVzq.webp\",\"youtube_video_id\":\"Dqn7FCXiQBk\"}','about','json',1,'en','2025-07-17 05:57:48','2025-08-01 03:41:46'),(11,'providers','[]','home','json',1,'es','2025-07-19 22:03:29','2025-07-20 04:18:30');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `subcategories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`name`)),
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subcategories_slug_unique` (`slug`),
  KEY `subcategories_category_id_foreign` (`category_id`),
  CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategories`
--

LOCK TABLES `subcategories` WRITE;
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
INSERT INTO `subcategories` VALUES (1,'{\"es\":\"Palos\",\"en\":\"Sticks\"}','palos','uploads/subcategories/2HHULPiCRdho9W7hzufH77UNnibfnkmKmU6sZTLL.png',1,'2025-07-31 06:51:52','2025-07-31 06:51:52'),(2,'{\"es\":\"Astillas\",\"en\":\"Splinters\"}','astillas','uploads/subcategories/XnQXvmFKzXl0UUaYroZQpTgTzoXbmLRor9DKO10M.png',1,'2025-07-31 06:52:17','2025-07-31 06:52:17'),(3,'{\"es\":\"Chips\",\"en\":\"Chips\"}','chips','uploads/subcategories/6Q7fLBY7GOmfp0fVSEOA3yD6wDh32BKMIkrwUpJ0.png',1,'2025-07-31 06:56:09','2025-07-31 06:56:09'),(4,'{\"es\":\"Molido\",\"en\":\"Powder\"}','molido','uploads/subcategories/FnARdsKyWYlvav8csAfQi8cJlfAm6Zv4RiePdoHC.png',1,'2025-07-31 06:56:30','2025-07-31 06:56:30'),(5,'{\"es\":\"Formato Natural\",\"en\":\"Natural Format\"}','formato-natural','uploads/subcategories/Sm53fptgEpKTR1vQ0gKms4ovu8lFvJRK9YhvMyvU.png',1,'2025-07-31 06:57:34','2025-07-31 06:57:34'),(6,'{\"es\":\"Varilla 23 Cm\",\"en\":\"Rod 23 Cm\"}','varilla-23-cm','uploads/subcategories/UTNwXbLb3pEpIp5mce18DjTGRRzC3tOl8Igrx3nB.png',2,'2025-07-31 07:01:36','2025-07-31 07:01:36'),(7,'{\"es\":\"Varilla 11 Cm\",\"en\":\"Rod 11 Cm\"}','varilla-11-cm','uploads/subcategories/LJZhJfI4GwiwGzU4vBpw1pd8x5A6zLAKjaYckahF.png',2,'2025-07-31 07:02:06','2025-07-31 07:02:06'),(8,'{\"es\":\"Cono\",\"en\":\"Cone\"}','cono','uploads/subcategories/h4EbyHjKGtwqQOFKI45DRIL8ioKyBtCQcITY6uDv.png',2,'2025-07-31 07:03:17','2025-07-31 07:03:17'),(9,'{\"es\":\"Pir\\u00e1mide\",\"en\":\"Pyramid\"}','piramide','uploads/subcategories/7ZNkAz1hcFD7sufjlMDE8VVu0WS1L49LE9a8WLyv.png',2,'2025-07-31 07:03:45','2025-07-31 07:03:45'),(10,'{\"es\":\"Rectangular\",\"en\":\"Rectangular\"}','rectangular','uploads/subcategories/PyQ0eIZGcyUs11XsUSPMzdlodr4w3htHM0TJwx4I.png',2,'2025-07-31 07:04:11','2025-07-31 07:04:11'),(11,'{\"es\":\"Sahumerio\",\"en\":\"Sahumerio\"}','sahumerio','uploads/subcategories/STst1hjPqPgCGqGl12wec5NyKbN1802ArNmN6q4C.png',3,'2025-07-31 07:07:07','2025-07-31 07:07:07');
/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'admin@email.com','2025-07-31 00:04:04','$2y$12$g5EEXaDOs0PyNOkNnOOHz.UdfizArtOE41JEYfsJdsR7pU3r534rW',NULL,NULL,NULL,'oa18bz08KC','2025-07-31 00:04:05','2025-07-31 00:04:05',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-08 17:45:33
