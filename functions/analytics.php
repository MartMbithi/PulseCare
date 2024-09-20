<?php
/*
 *   Crafted On Mon Aug 26 2024
 *   By the one and only Martin Mbithi (martin.mbithi@makueni.go.ke, www.martmbithi.github.io)
 * 
 *   www.makueni.go.ke
 *   info@makueni.go.ke
 *
 *
 *   The Government Of Makueni DevSecOps Band User License Agreement
 *   Copyright (c) 2023 Government of Makueni County
 *
 *
 *   1. LICENSE TO RULE
 *   Welcome to the elite club! Crafted by the ingenious Martin Mbithi, this software comes with the all-powerful,
 *   revocable, personal, non-exclusive, and non-transferable right to install and activate this masterpiece on ONE  
 *   lucky computer for your official, non-commercial escapades. Got a commercial itch? Better get that license first. 
 *   No peeking, sharing, or showing off this software to anyone else—strictly against the rules!
 *
 *   2. COPYRIGHT POWER
 *   This software, a creation of Martin Mbithi under the banner of the Government Of Makueni DevSecOps Band, is guarded by 
 *   copyright law and international treaties. So, don’t even think about messing with the proprietary notices, labels, 
 *   or marks—what’s his stays his!
 *
 *
 *   3. USE IT RIGHT OR LOSE IT
 *   You may not, and you may not let your fellow geeks:
 *   (a) hack, reverse engineer, decompile, decode, decrypt, disassemble, or attempt any sorcery to reveal the source code;
 *   (b) modify, remix, distribute, or create spinoffs of this masterpiece;
 *   (c) make copies (aside from your trusty backup), distribute, show off in public, transmit, sell, rent, lease, or otherwise
 *   exploit this software like it’s yours. Spoiler: it’s not!
 *
 *
 *   4. GAME OVER, MAN!
 *   This license is your golden ticket until one of us says otherwise. Want to end it? Smash the software and all its copies into
 *   digital dust. Break any rules? The license self-destructs, and you’ll need to nuke all copies—no second chances!
 *
 *
 *   5. NO PIXEL-PERFECT PROMISES
 *   Martin Mbithi and the Government Of Makueni DevSecOps Band don’t guarantee this software is glitch-free—think of it as a feature
 *   not a bug! We disclaim all other warranties, whether expressed or implied, including, but not limited to, implied warranties of merchantability
 *   fitness for a particular purpose, and non-infringement of third-party rights. Some jurisdictions have their own funky rules, so your mileage may
 *   vary. But remember: use at your own risk, brave user!
 *
 *
 *   6. KEEP THE PARTY GOING
 *   If a court zaps any part of this license, no worries—the rest of it keeps the party alive. One piece fails, but the agreement stands strong!
 *
 *
 *   7. NO DRAMA, NO DAMAGES
 *   Under no circumstances shall Martin Mbithi, the Government Of Makueni DevSecOps Band, or their minions be held responsible for any wild, indirect
 *   or accidental chaos from using this software—even if we warned you! And if you think you’ve got a claim, the most you’re getting is what you paid for the 
 *   license—if anything. Keep calm and code on!
 *
 */


if ($_SESSION['user_access_level'] == 'Supplier') {


  /* Suppliers Under Category A */
  $query = "SELECT COUNT(*) FROM users u 
    INNER JOIN suppliers_applications sa  ON u.user_id = sa.application_user_id  
    INNER JOIN categories c ON sa.application_category_id = c.category_id 
    WHERE category_type = 'Category A' AND u.user_id = '{$_SESSION['user_id']}'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($category_a);
  $stmt->fetch();
  $stmt->close();


  /* Suppliers Under Category B */
  $query = "SELECT COUNT(*) FROM users u 
    INNER JOIN suppliers_applications sa  ON u.user_id = sa.application_user_id  
    INNER JOIN categories c ON sa.application_category_id = c.category_id 
    WHERE category_type = 'Category B' AND u.user_id = '{$_SESSION['user_id']}'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($category_b);
  $stmt->fetch();
  $stmt->close();



  /* Suppliers Under Category C */
  $query = "SELECT COUNT(*) FROM users u 
    INNER JOIN suppliers_applications sa  ON u.user_id = sa.application_user_id  
    INNER JOIN categories c ON sa.application_category_id = c.category_id
    WHERE category_type = 'Category C' 
    AND u.user_id = '{$_SESSION['user_id']}' ";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($category_c);
  $stmt->fetch();
  $stmt->close();

  /* Responsive  Categories */
  $query = "SELECT COUNT(*) FROM users u 
    INNER JOIN suppliers_applications sa  ON u.user_id = sa.application_user_id  
    INNER JOIN categories c ON sa.application_category_id = c.category_id
    WHERE category_type = 'Category A' AND u.user_id = '{$_SESSION['user_id']}' 
    AND application_status = 'Responsive' 
    AND application_is_validated = '1'
    AND application_is_approved = '1'
    AND application_is_published = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($responsive_category_a);
  $stmt->fetch();
  $stmt->close();

  $query = "SELECT COUNT(*) FROM users u 
    INNER JOIN suppliers_applications sa  ON u.user_id = sa.application_user_id  
    INNER JOIN categories c ON sa.application_category_id = c.category_id
    WHERE category_type = 'Category B' AND u.user_id = '{$_SESSION['user_id']}' 
    AND application_status = 'Responsive'
    AND application_is_validated = '1'
    AND application_is_approved = '1'
    AND application_is_published = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($responsive_category_b);
  $stmt->fetch();
  $stmt->close();

  $query = "SELECT COUNT(*) FROM users u 
    INNER JOIN suppliers_applications sa  ON u.user_id = sa.application_user_id  
    INNER JOIN categories c ON sa.application_category_id = c.category_id
    WHERE category_type = 'Category C' AND u.user_id = '{$_SESSION['user_id']}' 
    AND application_status = 'Responsive'
    AND application_is_validated = '1'
    AND application_is_approved = '1'
    AND application_is_published = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($responsive_category_c);
  $stmt->fetch();
  $stmt->close();

  /* Non Responsive Categories */
  $query = "SELECT COUNT(*) FROM users u 
    INNER JOIN suppliers_applications sa  ON u.user_id = sa.application_user_id  
    INNER JOIN categories c ON sa.application_category_id = c.category_id
    WHERE category_type = 'Category A' AND u.user_id = '{$_SESSION['user_id']}' 
    AND application_status = 'Non Responsive'
    AND application_is_validated = '1'
    AND application_is_approved = '1'
    AND application_is_published = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($non_responsive_category_a);
  $stmt->fetch();
  $stmt->close();

  $query = "SELECT COUNT(*) FROM users u 
    INNER JOIN suppliers_applications sa  ON u.user_id = sa.application_user_id  
    INNER JOIN categories c ON sa.application_category_id = c.category_id
    WHERE category_type = 'Category B' AND u.user_id = '{$_SESSION['user_id']}' 
    AND application_status = 'Non Responsive'
    AND application_is_validated = '1'
    AND application_is_approved = '1'
    AND application_is_published = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($non_responsive_category_b);
  $stmt->fetch();
  $stmt->close();

  $query = "SELECT COUNT(*) FROM users u 
    INNER JOIN suppliers_applications sa  ON u.user_id = sa.application_user_id  
    INNER JOIN categories c ON sa.application_category_id = c.category_id
    WHERE category_type = 'Category C' AND u.user_id = '{$_SESSION['user_id']}' 
    AND application_status = 'Non Responsive'
    AND application_is_validated = '1'
    AND application_is_approved = '1'
    AND application_is_published = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($non_responsive_category_c);
  $stmt->fetch();
  $stmt->close();
} else if ($_SESSION['user_access_level'] == 'Evaluation Commitee') {
  /* Category A */

  /* Assigned Categories Under Supply Of Goods */
  $query = "SELECT COUNT(*) FROM assigned_categories ac
  INNER JOIN categories c ON c.category_id = ac.category_category_id
  WHERE c. category_type = 'Category A' 
  AND ac.category_user_id = '{$_SESSION['user_id']}'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($assigned_category_a);
  $stmt->fetch();
  $stmt->close();

  /* Evaluated */
  $query = "SELECT COUNT(*) FROM assigned_categories ac 
  INNER JOIN suppliers_applications ap ON ap.application_category_id = ac.category_category_id 
  INNER JOIN categories c ON c.category_id = ac.category_category_id 
  WHERE c.category_type = 'Category A'
  AND ac.category_user_id = '{$_SESSION['user_id']}' 
  AND ap.application_is_evaluated = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($assigned_evaluated_category_a);
  $stmt->fetch();
  $stmt->close();

  /* Awaiting Evaluation */
  $query = "SELECT COUNT(*) FROM assigned_categories ac 
  INNER JOIN suppliers_applications ap ON ap.application_category_id = ac.category_category_id 
  INNER JOIN categories c ON c.category_id = ac.category_category_id 
  WHERE c.category_type = 'Category A'
  AND ac.category_user_id = '{$_SESSION['user_id']}' 
  AND ap.application_is_evaluated = '0'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($assigned_not_evaluated_category_a);
  $stmt->fetch();
  $stmt->close();


  /* Category B */
  /* Assigned Categories Under Provision of Services */
  $query = "SELECT COUNT(*) FROM assigned_categories ac
  INNER JOIN categories c ON c.category_id = ac.category_category_id
  WHERE c. category_type = 'Category B' 
  AND ac.category_user_id = '{$_SESSION['user_id']}'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($assigned_category_b);
  $stmt->fetch();
  $stmt->close();

  /* Evaluated */
  $query = "SELECT COUNT(*) FROM assigned_categories ac 
  INNER JOIN suppliers_applications ap ON ap.application_category_id = ac.category_category_id 
  INNER JOIN categories c ON c.category_id = ac.category_category_id 
  WHERE c.category_type = 'Category B'
  AND ac.category_user_id = '{$_SESSION['user_id']}' 
  AND ap.application_is_evaluated = '0'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($assigned_evaluated_category_b);
  $stmt->fetch();
  $stmt->close();

  /* Awaiting Evaluation */
  $query = "SELECT COUNT(*) FROM assigned_categories ac 
  INNER JOIN suppliers_applications ap ON ap.application_category_id = ac.category_category_id 
  INNER JOIN categories c ON c.category_id = ac.category_category_id 
  WHERE c.category_type = 'Category B'
  AND ac.category_user_id = '{$_SESSION['user_id']}' 
  AND ap.application_is_evaluated = '0'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($assigned_not_evaluated_category_b);
  $stmt->fetch();
  $stmt->close();


  /* Category C */
  /* Assigned Categories Under Small Works */
  $query = "SELECT COUNT(*) FROM assigned_categories ac
  INNER JOIN categories c ON c.category_id = ac.category_category_id
  WHERE c. category_type = 'Category C' 
  AND ac.category_user_id = '{$_SESSION['user_id']}'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($assigned_category_c);
  $stmt->fetch();
  $stmt->close();

  /* Evaluated */
  $query = "SELECT COUNT(*) FROM assigned_categories ac 
  INNER JOIN suppliers_applications ap ON ap.application_category_id = ac.category_category_id 
  INNER JOIN categories c ON c.category_id = ac.category_category_id 
  WHERE c.category_type = 'Category C'
  AND ac.category_user_id = '{$_SESSION['user_id']}' 
  AND ap.application_is_evaluated = '0'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($assigned_evaluated_category_c);
  $stmt->fetch();
  $stmt->close();

  /* Awaiting Evaluation */
  $query = "SELECT COUNT(*) FROM assigned_categories ac 
  INNER JOIN suppliers_applications ap ON ap.application_category_id = ac.category_category_id 
  INNER JOIN categories c ON c.category_id = ac.category_category_id 
  WHERE c.category_type = 'Category C'
  AND ac.category_user_id = '{$_SESSION['user_id']}' 
  AND ap.application_is_evaluated = '0'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($assigned_not_evaluated_category_c);
  $stmt->fetch();
  $stmt->close();
} else {
  /* Registered Suppliers */
  $query = "SELECT COUNT(*) FROM users u WHERE user_access_level = 'Supplier'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($suppliers);
  $stmt->fetch();
  $stmt->close();

  /* Suppliers Under Category A */
  $query = "SELECT COUNT(*) FROM users u INNER JOIN suppliers_applications sa  ON u.user_id = sa.application_user_id  INNER JOIN categories c ON sa.application_category_id = c.category_id WHERE category_type = 'Category A'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($category_a);
  $stmt->fetch();
  $stmt->close();


  /* Suppliers Under Category B */
  $query = "SELECT COUNT(*) FROM users u INNER JOIN suppliers_applications sa  ON u.user_id = sa.application_user_id  INNER JOIN categories c ON sa.application_category_id = c.category_id WHERE category_type = 'Category B'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($category_b);
  $stmt->fetch();
  $stmt->close();



  /* Suppliers Under Category C */
  $query = "SELECT COUNT(*) FROM users u INNER JOIN suppliers_applications sa  ON u.user_id = sa.application_user_id  INNER JOIN categories c ON sa.application_category_id = c.category_id WHERE category_type = 'Category C'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($category_c);
  $stmt->fetch();
  $stmt->close();

  /* Evaluation Committee Dashboard  Analytics */

  /* 1. Supply of goods Not Evaluated Suppliers */
  $query = "SELECT COUNT(*)  FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category A' AND application_is_evaluated = '0' ";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($not_evaluated_category_a);
  $stmt->fetch();
  $stmt->close();

  /* 2. Proviosion of services */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category B' AND application_is_evaluated = '0'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($not_evaluated_category_b);
  $stmt->fetch();
  $stmt->close();

  /* 3. Small Works  */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category C' AND application_is_evaluated = '0'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($not_evaluated_category_c);
  $stmt->fetch();
  $stmt->close();

  /* Evaluation Committee Dashboard  Analytics -  Evaluated */

  /* 1. Supply of goods Evaluated Suppliers */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category A' AND application_is_evaluated = '1' ";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($evaluated_category_a);
  $stmt->fetch();
  $stmt->close();

  /* 2. Proviosion of services */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category B' AND  application_is_evaluated = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($evaluated_category_b);
  $stmt->fetch();
  $stmt->close();

  /* 3. Small Works  */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category C' AND  application_is_evaluated = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($evaluated_category_c);
  $stmt->fetch();
  $stmt->close();


  /* Director Procurement Dashboard Access Level -  Not Validated */

  /* 1. Supply of goods  */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category A' AND  application_is_validated = '0' AND application_is_evaluated = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($non_validated_category_a);
  $stmt->fetch();
  $stmt->close();


  /* 2. Provision of services */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category B' AND  application_is_validated = '0' AND application_is_evaluated = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($non_validated_category_b);
  $stmt->fetch();
  $stmt->close();


  /* 3. Small works */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category C' AND application_is_validated = '0' AND application_is_evaluated = '1' ";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($non_validated_category_c);
  $stmt->fetch();
  $stmt->close();



  /* Director Procurement Validated Applications */

  /* 1. Supply of goods  - Responsive And  Validated */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category A' AND  application_is_validated = '1' AND application_is_evaluated = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($validated_category_a);
  $stmt->fetch();
  $stmt->close();

  /* 2. Provision of services */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category B'  AND application_is_validated = '1' AND application_is_evaluated = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($validated_category_b);
  $stmt->fetch();
  $stmt->close();

  /* 3. Small works */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category C' AND application_is_validated = '1' AND application_is_evaluated = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($validated_category_c);
  $stmt->fetch();
  $stmt->close();



  /* C.O Planning Dashboard **************************************** */


  /* 1. Supply of goods  -  Not Approved */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category A' 
  AND application_is_validated = '1' 
  AND application_is_approved = '0'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($not_approved_category_a);
  $stmt->fetch();
  $stmt->close();


  /* 2. Provision of services */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category B' 
  AND  application_is_validated = '1' 
  AND application_is_approved = '0'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($not_approved_category_b);
  $stmt->fetch();
  $stmt->close();

  /* 3. Small works */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category C' AND application_is_validated = '1' 
  AND application_is_approved = '0'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($not_approved_category_c);
  $stmt->fetch();
  $stmt->close();


  /* 1. Supply of goods  -   Approved */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
    INNER JOIN categories c ON sa.application_category_id = c.category_id 
    WHERE category_type = 'Category A' 
    AND application_is_validated = '1' 
    AND application_is_approved = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($approved_category_a);
  $stmt->fetch();
  $stmt->close();


  /* 2. Provision of services */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category B' 
  AND  application_is_validated = '1' 
  AND application_is_approved = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($approved_category_b);
  $stmt->fetch();
  $stmt->close();

  /* 3. Small works */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category C' AND application_is_validated = '1' 
  AND application_is_approved = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($approved_category_c);
  $stmt->fetch();
  $stmt->close();



  /* Director Procurement Published Suppliers */


  /* 1. Supply of goods   */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category A' 
  AND application_is_validated = '1' 
  AND application_is_approved = '1'
  AND application_is_published = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($not_published_category_a);
  $stmt->fetch();
  $stmt->close();


  /* 2. Provision of services */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category B' 
  AND  application_is_validated = '1' 
  AND application_is_approved = '1'
  AND application_is_published = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($not_published_category_b);
  $stmt->fetch();
  $stmt->close();

  /* 3. Small works */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category C' 
  AND application_is_validated = '1' 
  AND application_is_approved = '1'
  AND application_is_published = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($not_published_category_c);
  $stmt->fetch();
  $stmt->close();


  /* 1. Supply of goods  -   Published */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category A' 
  AND application_is_validated = '1' 
  AND application_is_approved = '1'
  AND application_is_published = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($published_category_a);
  $stmt->fetch();
  $stmt->close();


  /* 2. Provision of services */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category B' 
  AND  application_is_validated = '1' 
  AND application_is_approved = '1'
  AND application_is_published = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($published_category_b);
  $stmt->fetch();
  $stmt->close();

  /* 3. Small works */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category C' 
  AND application_is_validated = '1' 
  AND application_is_approved = '1'
  AND application_is_published = '1'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($published_category_c);
  $stmt->fetch();
  $stmt->close();


  /* Reponsive And Non Responsive Suppliers */

  /* 1. Supply of goods - Responsive   */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category A' AND application_status = 'Responsive' ";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($category_a_responsive);
  $stmt->fetch();
  $stmt->close();


  /* 2. Provision of services  - Responsive*/
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category B' AND application_status = 'Responsive'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($category_b_responsive);
  $stmt->fetch();
  $stmt->close();

  /* 3. Small works - Responsive */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category C' AND application_status = 'Responsive'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($category_c_responsive);
  $stmt->fetch();
  $stmt->close();


  /* 1. Supply of goods  -   Non Responsive */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category A' AND application_status = 'Non Responsive'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($category_a_non_responsive);
  $stmt->fetch();
  $stmt->close();


  /* 2. Provision of services  - Non Responsive*/
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category B' AND application_status = 'Non Responsive'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($category_b_non_responsive);
  $stmt->fetch();
  $stmt->close();

  /* 3. Small works - Non Responsive */
  $query = "SELECT COUNT(*) FROM suppliers_applications sa  
  INNER JOIN categories c ON sa.application_category_id = c.category_id 
  WHERE category_type = 'Category C' AND application_status = 'Non Responsive'";
  $stmt = $mysqli->prepare($query);
  $stmt->execute();
  $stmt->bind_result($category_c_non_responsive);
  $stmt->fetch();
  $stmt->close();
}
