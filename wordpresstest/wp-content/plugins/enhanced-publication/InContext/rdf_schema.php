<?php
header('Content-Type: application/rdf+xml; charset=UTF-8');
header('Cache-Control: no-cache');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
		 xmlns:escape-system="http://purl.utwente.nl/ns/escape-system.owl#"
		 xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
		 xmlns:owl="http://www.w3.org/2002/07/owl#"
		 xmlns:dcterms="http://purl.org/dc/terms/"
		 xmlns:skos="http://www.w3.org/2004/02/skos/core#"
		 xmlns:sw-vocab-status="http://www.w3.org/2003/06/sw-vocab-status/">

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-escape-discourserelationships.owl#appliedIn">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#applies"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#applies">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Applies</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-escape-discourserelationships.owl#appliedIn"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#referredBy"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/relatedTo">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#SymmetricProperty"/>
		<rdfs:label>Related to</rdfs:label>
		<rdfs:comment>The most generic relationships. It expresses connection between two resources without specifying the nature of such connection</rdfs:comment>
		<rdfs:range rdf:resource="http://xmlns.com/foaf/0.1/Document"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/alternativeTo">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#SymmetricProperty"/>
		<rdfs:label>Alternative to</rdfs:label>
		<rdfs:subPropertyOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/relatedTo"/>
		<rdfs:comment>It connects two different resources that can be considered alternative interpretations</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/inconsistentWith">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#SymmetricProperty"/>
		<rdfs:label>Inconsistent with</rdfs:label>
		<rdfs:subPropertyOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/relatedTo"/>
		<rdfs:comment>It expresses inconsistency between two resources. It is a bidirectional relationship</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/consistentWith">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#SymmetricProperty"/>
		<rdfs:label>Consistent with</rdfs:label>
		<rdfs:subPropertyOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/relatedTo"/>
		<rdfs:comment>It expresses consistency between two resources. It is a bidirectional relationship</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/relevantTo">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#SymmetricProperty"/>
		<rdfs:label>Relevant to</rdfs:label>
		<rdfs:subPropertyOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/relatedTo"/>
		<rdfs:comment>It expresses the fact that a resource is relevant for another one and vice-versa</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/refersTo">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Refers to</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#referredBy"/>
		<rdfs:comment>It connects an entity with another entity in an unidirectional way</rdfs:comment>
		<rdfs:subPropertyOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/relatedTo"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#referredBy">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Referred by</rdfs:label>
		<owl:inverseOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/refersTo"/>
		<rdfs:subPropertyOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/relatedTo"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/inResponseTo">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>In response to</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#hasResponse"/>
		<rdfs:subPropertyOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/refersTo"/>
		<rdfs:comment>Expresses the fact that the existence of one Entity is mainly directed to react to another Entity</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#hasResponse">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Has response</rdfs:label>
		<owl:inverseOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/inResponseTo"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#referredBy"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/discusses">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Discusses</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#discussedBy"/>
		<rdfs:subPropertyOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/inResponseTo"/>
		<rdfs:comment>It expresses the fact that one entity is talking about another one without expressing agreement or disagreement</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#discussedBy">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Discussed by</rdfs:label>
		<owl:inverseOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/discusses"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#hasResponse"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/agreesWith">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Agrees with</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#agreedBy"/>
		<rdfs:subPropertyOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/inResponseTo"/>
		<rdfs:comment>It expresses the fact that one entity is talking about another one expressing agreement</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#agreedBy">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Agreed by</rdfs:label>
		<owl:inverseOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/agreesWith"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#hasResponse"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/disagreesWith">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Disagrees with</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#disagreedBy"/>
		<rdfs:subPropertyOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/inResponseTo"/>
		<rdfs:comment>It expresses the fact that one entity is talking about another one expressing disagreement</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#disagreedBy">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Disagreed by</rdfs:label>
		<owl:inverseOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/disagreesWith"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#hasResponse"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/motivatedBy">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Motivated by</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#motivated"/>
		<rdfs:subPropertyOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/refersTo"/>
		<rdfs:comment>An action motivated by some resource</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#motivated">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Motivated</rdfs:label>
		<owl:inverseOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/motivatedBy"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#referredBy"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/arisesFrom">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Arises from</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#aroused"/>
		<rdfs:subPropertyOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/refersTo"/>
		<rdfs:comment>Something (question, doubt...) that arises because of a resource</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#aroused">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Aroused</rdfs:label>
		<owl:inverseOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/arisesFrom"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#referredBy"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/cites">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Cites</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#citedBy"/>
		<rdfs:subPropertyOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/refersTo"/>
		<rdfs:comment>An explicit reference to another resource for supporting the discourse.</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#citedBy">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Cited by</rdfs:label>
		<owl:inverseOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/cites"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#referredBy"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/">
		<dcterms:title>DCMI Metadata Terms in the /terms/ namespace</dcterms:title>
		<dcterms:publisher rdf:resource="http://purl.org/dc/aboutdcmi#DCMI"/>
		<dcterms:modified>2010-10-11</dcterms:modified>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/title">
		<rdfs:label>Title</rdfs:label>
		<rdfs:comment>A name given to the resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<dcterms:modified>2010-10-11</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#titleT-002"/>
		<rdfs:range rdf:resource="http://www.w3.org/2000/01/rdf-schema#Literal"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/title"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/creator">
		<rdfs:label>Creator</rdfs:label>
		<rdfs:comment>An entity primarily responsible for making the resource.</rdfs:comment>
		<dcterms:description>Examples of a Creator include a person, an organization, or a service.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<dcterms:modified>2010-10-11</dcterms:modified>
		<owl:equivalentProperty rdf:resource="http://xmlns.com/foaf/0.1/maker"/>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#creatorT-002"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/creator"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/contributor"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/subject">
		<rdfs:label>Subject</rdfs:label>
		<rdfs:comment>The topic of the resource.</rdfs:comment>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#isSubjectOf"/>
		<dcterms:description>Typically, the subject will be represented using keywords, key phrases, or classification codes. Recommended best practice is to use a controlled vocabulary. To describe the spatial or temporal topic of the resource, use the Coverage element.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#subjectT-001"/>
		<skos:note>This term is intended to be used with non-literal values as defined in the DCMI Abstract Model (http://dublincore.org/documents/abstract-model/).  As of December 2007, the DCMI Usage Board is seeking a way to express this intention with a formal range declaration.</skos:note>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/subject"/>
		<rdfs:range rdf:resource="http://www.w3.org/2004/02/skos/core#Concept"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#isSubjectOf">
		<rdfs:label>Is subject of</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.org/dc/terms/subject"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:domain rdf:resource="http://www.w3.org/2004/02/skos/core#Concept"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/description">
		<rdfs:label>Description</rdfs:label>
		<rdfs:comment>An account of the resource.</rdfs:comment>
		<dcterms:description>Description may include but is not limited to: an abstract, a table of contents, a graphical representation, or a free-text account of the resource.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#descriptionT-001"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/description"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/publisher">
		<rdfs:label>Publisher</rdfs:label>
		<rdfs:comment>An entity responsible for making the resource available.</rdfs:comment>
		<dcterms:description>Examples of a Publisher include a person, an organization, or a service.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<dcterms:modified>2010-10-11</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#publisherT-001"/>
		<rdfs:range rdf:resource="http://purl.org/dc/terms/Agent"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/publisher"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/contributor">
		<rdfs:label>Contributor</rdfs:label>
		<rdfs:comment>An entity responsible for making contributions to the resource.</rdfs:comment>
		<dcterms:description>Examples of a Contributor include a person, an organization, or a service.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<dcterms:modified>2010-10-11</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#contributorT-001"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/contributor"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/date">
		<rdfs:label>Date</rdfs:label>
		<rdfs:comment>A point or period of time associated with an event in the lifecycle of the resource.</rdfs:comment>
		<dcterms:description>Date may be used to express temporal information at any level of granularity.  Recommended best practice is to use an encoding scheme, such as the W3CDTF profile of ISO 8601 [W3CDTF].</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#dateT-001"/>
		<rdfs:range rdf:resource="http://www.w3.org/2001/XMLSchema#date"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/date"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/type">
		<rdfs:label>Type</rdfs:label>
		<rdfs:comment>The nature or genre of the resource.</rdfs:comment>
		<dcterms:description>Recommended best practice is to use a controlled vocabulary such as the DCMI Type Vocabulary [DCMITYPE]. To describe the file format, physical medium, or dimensions of the resource, use the Format element.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#typeT-001"/>
		<rdfs:range rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/type"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/format">
		<rdfs:label>Format</rdfs:label>
		<rdfs:comment>The file format, physical medium, or dimensions of the resource.</rdfs:comment>
		<dcterms:description>Examples of dimensions include size and duration. Recommended best practice is to use a controlled vocabulary such as the list of Internet Media Types [MIME].</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#formatT-001"/>
		<rdfs:range rdf:resource="http://purl.org/dc/terms/MediaTypeOrExtent"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/format"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/identifier">
		<rdfs:label>Identifier</rdfs:label>
		<rdfs:comment>An unambiguous reference to the resource within a given context.</rdfs:comment>
		<dcterms:description>Recommended best practice is to identify the resource by means of a string conforming to a formal identification system. </dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#identifierT-001"/>
		<rdfs:range rdf:resource="http://www.w3.org/2000/01/rdf-schema#Literal"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/identifier"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/source">
		<rdfs:label>Source</rdfs:label>
		<rdfs:comment>A related resource from which the described resource is derived.</rdfs:comment>
		<dcterms:description>The described resource may be derived from the related resource in whole or in part. Recommended best practice is to identify the related resource by means of a string conforming to a formal identification system.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#sourceT-001"/>
		<skos:note>This term is intended to be used with non-literal values as defined in the DCMI Abstract Model (http://dublincore.org/documents/abstract-model/).  As of December 2007, the DCMI Usage Board is seeking a way to express this intention with a formal range declaration.</skos:note>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/source"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/relation"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/language">
		<rdfs:label>Language</rdfs:label>
		<rdfs:comment>A language of the resource.</rdfs:comment>
		<dcterms:description>Recommended best practice is to use a controlled vocabulary such as RFC 4646 [RFC4646].</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#languageT-001"/>
		<rdfs:range rdf:resource="http://purl.org/dc/terms/LinguisticSystem"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/language"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/relation">
		<rdfs:label>Relation</rdfs:label>
		<rdfs:comment>A related resource.</rdfs:comment>
		<dcterms:description>Recommended best practice is to identify the related resource by means of a string conforming to a formal identification system. </dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#relationT-001"/>
		<skos:note>This term is intended to be used with non-literal values as defined in the DCMI Abstract Model (http://dublincore.org/documents/abstract-model/).  As of December 2007, the DCMI Usage Board is seeking a way to express this intention with a formal range declaration.</skos:note>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/relation"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/coverage">
		<rdfs:label>Coverage</rdfs:label>
		<rdfs:comment>The spatial or temporal topic of the resource, the spatial applicability of the resource, or the jurisdiction under which the resource is relevant.</rdfs:comment>
		<dcterms:description>Spatial topic and spatial applicability may be a named place or a location specified by its geographic coordinates. Temporal topic may be a named period, date, or date range. A jurisdiction may be a named administrative entity or a geographic place to which the resource applies. Recommended best practice is to use a controlled vocabulary such as the Thesaurus of Geographic Names [TGN]. Where appropriate, named places or time periods can be used in preference to numeric identifiers such as sets of coordinates or date ranges.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#coverageT-001"/>
		<rdfs:range rdf:resource="http://purl.org/dc/terms/LocationPeriodOrJurisdiction"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/coverage"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/rights">
		<rdfs:label>Rights</rdfs:label>
		<rdfs:comment>Information about rights held in and over the resource.</rdfs:comment>
		<dcterms:description>Typically, rights information includes a statement about various property rights associated with the resource, including intellectual property rights.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#rightsT-001"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/rights"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/audience">
		<rdfs:label>Audience</rdfs:label>
		<rdfs:comment>A class of entity for whom the resource is intended or useful.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2001-05-21</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#audience-003"/>
		<rdfs:range rdf:resource="http://purl.org/dc/terms/AgentClass"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/alternative">
		<rdfs:label>Alternative Title</rdfs:label>
		<rdfs:comment>An alternative name for the resource.</rdfs:comment>
		<dcterms:description>The distinction between titles and alternative titles is application-specific.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2010-10-11</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#alternative-003"/>
		<rdfs:range rdf:resource="http://www.w3.org/2000/01/rdf-schema#Literal"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/title"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/title"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/tableOfContents">
		<rdfs:label>Table Of Contents</rdfs:label>
		<rdfs:comment>A list of subunits of the resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#tableOfContents-003"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/description"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/description"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/abstract">
		<rdfs:label>Abstract</rdfs:label>
		<rdfs:comment>A summary of the resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#abstract-003"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/description"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/description"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/created">
		<rdfs:label>Date Created</rdfs:label>
		<rdfs:comment>Date of creation of the resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#created-003"/>
		<rdfs:range rdf:resource="http://www.w3.org/2000/01/rdf-schema#Literal"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/date"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/date"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/valid">
		<rdfs:label>Date Valid</rdfs:label>
		<rdfs:comment>Date (often a range) of validity of a resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#valid-003"/>
		<rdfs:range rdf:resource="http://www.w3.org/2000/01/rdf-schema#Literal"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/date"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/date"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/available">
		<rdfs:label>Date Available</rdfs:label>
		<rdfs:comment>Date (often a range) that the resource became or will become available.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#available-003"/>
		<rdfs:range rdf:resource="http://www.w3.org/2000/01/rdf-schema#Literal"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/date"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/date"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/issued">
		<rdfs:label>Date Issued</rdfs:label>
		<rdfs:comment>Date of formal issuance (e.g., publication) of the resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#issued-003"/>
		<rdfs:range rdf:resource="http://www.w3.org/2000/01/rdf-schema#Literal"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/date"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/date"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/modified">
		<rdfs:label>Date Modified</rdfs:label>
		<rdfs:comment>Date on which the resource was changed.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#modified-003"/>
		<rdfs:range rdf:resource="http://www.w3.org/2000/01/rdf-schema#Literal"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/date"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/date"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/extent">
		<rdfs:label>Extent</rdfs:label>
		<rdfs:comment>The size or duration of the resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#extent-003"/>
		<rdfs:range rdf:resource="http://purl.org/dc/terms/SizeOrDuration"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/format"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/format"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/medium">
		<rdfs:label>Medium</rdfs:label>
		<rdfs:comment>The material or physical carrier of the resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#medium-003"/>
		<rdfs:domain rdf:resource="http://purl.org/dc/terms/PhysicalResource"/>
		<rdfs:range rdf:resource="http://purl.org/dc/terms/PhysicalMedium"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/format"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/format"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/isVersionOf">
		<rdfs:label>Is Version Of</rdfs:label>
		<rdfs:comment>A related resource of which the described resource is a version, edition, or adaptation.</rdfs:comment>
		<dcterms:description>Changes in version imply substantive changes in content rather than differences in format.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#isVersionOf-003"/>
		<skos:note>This term is intended to be used with non-literal values as defined in the DCMI Abstract Model (http://dublincore.org/documents/abstract-model/).  As of December 2007, the DCMI Usage Board is seeking a way to express this intention with a formal range declaration.</skos:note>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/relation"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/relation"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/hasVersion">
		<rdfs:label>Has Version</rdfs:label>
		<rdfs:comment>A related resource that is a version, edition, or adaptation of the described resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#hasVersion-003"/>
		<skos:note>This term is intended to be used with non-literal values as defined in the DCMI Abstract Model (http://dublincore.org/documents/abstract-model/).  As of December 2007, the DCMI Usage Board is seeking a way to express this intention with a formal range declaration.</skos:note>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/relation"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/relation"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/isReplacedBy">
		<rdfs:label>Is Replaced By</rdfs:label>
		<rdfs:comment>A related resource that supplants, displaces, or supersedes the described resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#isReplacedBy-003"/>
		<skos:note>This term is intended to be used with non-literal values as defined in the DCMI Abstract Model (http://dublincore.org/documents/abstract-model/).  As of December 2007, the DCMI Usage Board is seeking a way to express this intention with a formal range declaration.</skos:note>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/relation"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/relation"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/replaces">
		<rdfs:label>Replaces</rdfs:label>
		<rdfs:comment>A related resource that is supplanted, displaced, or superseded by the described resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#replaces-003"/>
		<skos:note>This term is intended to be used with non-literal values as defined in the DCMI Abstract Model (http://dublincore.org/documents/abstract-model/).  As of December 2007, the DCMI Usage Board is seeking a way to express this intention with a formal range declaration.</skos:note>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/relation"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/relation"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/isRequiredBy">
		<rdfs:label>Is Required By</rdfs:label>
		<rdfs:comment>A related resource that requires the described resource to support its function, delivery, or coherence.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#isRequiredBy-003"/>
		<skos:note>This term is intended to be used with non-literal values as defined in the DCMI Abstract Model (http://dublincore.org/documents/abstract-model/).  As of December 2007, the DCMI Usage Board is seeking a way to express this intention with a formal range declaration.</skos:note>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/relation"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/relation"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/requires">
		<rdfs:label>Requires</rdfs:label>
		<rdfs:comment>A related resource that is required by the described resource to support its function, delivery, or coherence.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#requires-003"/>
		<skos:note>This term is intended to be used with non-literal values as defined in the DCMI Abstract Model (http://dublincore.org/documents/abstract-model/).  As of December 2007, the DCMI Usage Board is seeking a way to express this intention with a formal range declaration.</skos:note>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/relation"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/relation"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/isPartOf">
		<rdfs:label>Is Part Of</rdfs:label>
		<rdfs:comment>A related resource in which the described resource is physically or logically included.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#isPartOf-003"/>
		<skos:note>This term is intended to be used with non-literal values as defined in the DCMI Abstract Model (http://dublincore.org/documents/abstract-model/).  As of December 2007, the DCMI Usage Board is seeking a way to express this intention with a formal range declaration.</skos:note>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/relation"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/relation"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/hasPart">
		<rdfs:label>Has Part</rdfs:label>
		<rdfs:comment>A related resource that is included either physically or logically in the described resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#hasPart-003"/>
		<skos:note>This term is intended to be used with non-literal values as defined in the DCMI Abstract Model (http://dublincore.org/documents/abstract-model/).  As of December 2007, the DCMI Usage Board is seeking a way to express this intention with a formal range declaration.</skos:note>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/relation"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/relation"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/isReferencedBy">
		<rdfs:label>Is Referenced By</rdfs:label>
		<rdfs:comment>A related resource that references, cites, or otherwise points to the described resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#isReferencedBy-003"/>
		<skos:note>This term is intended to be used with non-literal values as defined in the DCMI Abstract Model (http://dublincore.org/documents/abstract-model/).  As of December 2007, the DCMI Usage Board is seeking a way to express this intention with a formal range declaration.</skos:note>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/relation"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/relation"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/references">
		<rdfs:label>References</rdfs:label>
		<rdfs:comment>A related resource that is referenced, cited, or otherwise pointed to by the described resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#references-003"/>
		<skos:note>This term is intended to be used with non-literal values as defined in the DCMI Abstract Model (http://dublincore.org/documents/abstract-model/).  As of December 2007, the DCMI Usage Board is seeking a way to express this intention with a formal range declaration.</skos:note>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/relation"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/relation"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/isFormatOf">
		<rdfs:label>Is Format Of</rdfs:label>
		<rdfs:comment>A related resource that is substantially the same as the described resource, but in another format.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#isFormatOf-003"/>
		<skos:note>This term is intended to be used with non-literal values as defined in the DCMI Abstract Model (http://dublincore.org/documents/abstract-model/).  As of December 2007, the DCMI Usage Board is seeking a way to express this intention with a formal range declaration.</skos:note>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/relation"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/relation"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/hasFormat">
		<rdfs:label>Has Format</rdfs:label>
		<rdfs:comment>A related resource that is substantially the same as the pre-existing described resource, but in another format.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#hasFormat-003"/>
		<skos:note>This term is intended to be used with non-literal values as defined in the DCMI Abstract Model (http://dublincore.org/documents/abstract-model/).  As of December 2007, the DCMI Usage Board is seeking a way to express this intention with a formal range declaration.</skos:note>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/relation"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/relation"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/conformsTo">
		<rdfs:label>Conforms To</rdfs:label>
		<rdfs:comment>An established standard to which the described resource conforms.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2001-05-21</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#conformsTo-003"/>
		<rdfs:range rdf:resource="http://purl.org/dc/terms/Standard"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/relation"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/relation"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/spatial">
		<rdfs:label>Spatial Coverage</rdfs:label>
		<rdfs:comment>Spatial characteristics of the resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#spatial-003"/>
		<rdfs:range rdf:resource="http://purl.org/dc/terms/Location"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/coverage"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/coverage"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/temporal">
		<rdfs:label>Temporal Coverage</rdfs:label>
		<rdfs:comment>Temporal characteristics of the resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#temporal-003"/>
		<rdfs:range rdf:resource="http://purl.org/dc/terms/PeriodOfTime"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/coverage"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/coverage"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/mediator">
		<rdfs:label>Mediator</rdfs:label>
		<rdfs:comment>An entity that mediates access to the resource and for whom the resource is intended or useful.</rdfs:comment>
		<dcterms:description>In an educational context, a mediator might be a parent, teacher, teaching assistant, or care-giver.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2001-05-21</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#mediator-003"/>
		<rdfs:range rdf:resource="http://purl.org/dc/terms/AgentClass"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/audience"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/dateAccepted">
		<rdfs:label>Date Accepted</rdfs:label>
		<rdfs:comment>Date of acceptance of the resource.</rdfs:comment>
		<dcterms:description>Examples of resources to which a Date Accepted may be relevant are a thesis (accepted by a university department) or an article (accepted by a journal).</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2002-07-13</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#dateAccepted-002"/>
		<rdfs:range rdf:resource="http://www.w3.org/2000/01/rdf-schema#Literal"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/date"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/date"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/dateCopyrighted">
		<rdfs:label>Date Copyrighted</rdfs:label>
		<rdfs:comment>Date of copyright.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2002-07-13</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#dateCopyrighted-002"/>
		<rdfs:range rdf:resource="http://www.w3.org/2000/01/rdf-schema#Literal"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/date"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/date"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/dateSubmitted">
		<rdfs:label>Date Submitted</rdfs:label>
		<rdfs:comment>Date of submission of the resource.</rdfs:comment>
		<dcterms:description>Examples of resources to which a Date Submitted may be relevant are a thesis (submitted to a university department) or an article (submitted to a journal).</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2002-07-13</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#dateSubmitted-002"/>
		<rdfs:range rdf:resource="http://www.w3.org/2000/01/rdf-schema#Literal"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/date"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/date"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/educationLevel">
		<rdfs:label>Audience Education Level</rdfs:label>
		<rdfs:comment>A class of entity, defined in terms of progression through an educational or training context, for which the described resource is intended.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2002-07-13</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#educationLevel-002"/>
		<rdfs:range rdf:resource="http://purl.org/dc/terms/AgentClass"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/audience"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/accessRights">
		<rdfs:label>Access Rights</rdfs:label>
		<rdfs:comment>Information about who can access the resource or an indication of its security status.</rdfs:comment>
		<dcterms:description>Access Rights may include information regarding access or restrictions based on privacy, security, or other policies.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2003-02-15</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#accessRights-002"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/rights"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/rights"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/bibliographicCitation">
		<rdfs:label>Bibliographic Citation</rdfs:label>
		<rdfs:comment>A bibliographic reference for the resource.</rdfs:comment>
		<dcterms:description>Recommended practice is to include sufficient bibliographic detail to identify the resource as unambiguously as possible.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2003-02-15</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#bibliographicCitation-002"/>
		<rdfs:domain rdf:resource="http://purl.org/dc/terms/BibliographicResource"/>
		<rdfs:range rdf:resource="http://www.w3.org/2000/01/rdf-schema#Literal"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/identifier"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/identifier"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/license">
		<rdfs:label>License</rdfs:label>
		<rdfs:comment>A legal document giving official permission to do something with the resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2004-06-14</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#license-002"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/elements/1.1/rights"/>
		<rdfs:subPropertyOf rdf:resource="http://purl.org/dc/terms/rights"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/rightsHolder">
		<rdfs:label>Rights Holder</rdfs:label>
		<rdfs:comment>A person or organization owning or managing rights over the resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2004-06-14</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#rightsHolder-002"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/provenance">
		<rdfs:label>Provenance</rdfs:label>
		<rdfs:comment>A statement of any changes in ownership and custody of the resource since its creation that are significant for its authenticity, integrity, and interpretation.</rdfs:comment>
		<dcterms:description>The statement may include a description of any changes successive custodians made to the resource.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2004-09-20</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#provenance-002"/>
		<rdfs:range rdf:resource="http://purl.org/dc/terms/ProvenanceStatement"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/instructionalMethod">
		<rdfs:label>Instructional Method</rdfs:label>
		<rdfs:comment>A process, used to engender knowledge, attitudes and skills, that the described resource is designed to support.</rdfs:comment>
		<dcterms:description>Instructional Method will typically include ways of presenting instructional materials or conducting instructional activities, patterns of learner-to-learner and learner-to-instructor interactions, and mechanisms by which group and individual levels of learning are measured.  Instructional methods include all aspects of the instruction and learning processes from planning and implementation through evaluation and feedback.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2005-06-13</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#instructionalMethod-002"/>
		<rdfs:range rdf:resource="http://purl.org/dc/terms/MethodOfInstruction"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/accrualMethod">
		<rdfs:label>Accrual Method</rdfs:label>
		<rdfs:comment>The method by which items are added to a collection.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2005-06-13</dcterms:issued>
		<dcterms:modified>2010-10-11</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#accrualMethod-003"/>
		<rdfs:domain rdf:resource="http://purl.org/dc/dcmitype/Collection"/>
		<rdfs:range rdf:resource="http://purl.org/dc/terms/MethodOfAccrual"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/accrualPeriodicity">
		<rdfs:label>Accrual Periodicity</rdfs:label>
		<rdfs:comment>The frequency with which items are added to a collection.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2005-06-13</dcterms:issued>
		<dcterms:modified>2010-10-11</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#accrualPeriodicity-003"/>
		<rdfs:domain rdf:resource="http://purl.org/dc/dcmitype/Collection"/>
		<rdfs:range rdf:resource="http://purl.org/dc/terms/Frequency"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/accrualPolicy">
		<rdfs:label>Accrual Policy</rdfs:label>
		<rdfs:comment>The policy governing the addition of items to a collection.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2005-06-13</dcterms:issued>
		<dcterms:modified>2010-10-11</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Property"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#accrualPolicy-003"/>
		<rdfs:domain rdf:resource="http://purl.org/dc/dcmitype/Collection"/>
		<rdfs:range rdf:resource="http://purl.org/dc/terms/Policy"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/Agent">
		<rdfs:label>Agent</rdfs:label>
		<rdfs:comment>A resource that acts or has the power to act.</rdfs:comment>
		<dcterms:description>Examples of Agent include person, organization, and software agent.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<rdf:type rdf:resource="http://purl.org/dc/terms/AgentClass"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#Agent-001"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/AgentClass">
		<rdfs:label>Agent Class</rdfs:label>
		<rdfs:comment>A group of agents.</rdfs:comment>
		<dcterms:description>Examples of Agent Class include groups seen as classes, such as students, women, charities, lecturers.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#AgentClass-001"/>
		<rdfs:subClassOf rdf:resource="http://purl.org/dc/terms/AgentClass"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/BibliographicResource">
		<rdfs:label>Bibliographic Resource</rdfs:label>
		<rdfs:comment>A book, article, or other documentary resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#BibliographicResource-001"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/FileFormat">
		<rdfs:label>File Format</rdfs:label>
		<rdfs:comment>A digital resource format.</rdfs:comment>
		<dcterms:description>Examples include the formats defined by the list of Internet Media Types.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#FileFormat-001"/>
		<rdfs:subClassOf rdf:resource="http://purl.org/dc/terms/MediaType"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/Frequency">
		<rdfs:label>Frequency</rdfs:label>
		<rdfs:comment>A rate at which something recurs.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#Frequency-001"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/Jurisdiction">
		<rdfs:label>Jurisdiction</rdfs:label>
		<rdfs:comment>The extent or range of judicial, law enforcement, or other authority.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#Jurisdiction-001"/>
		<rdfs:subClassOf rdf:resource="http://purl.org/dc/terms/LocationPeriodOrJurisdiction"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/LicenseDocument">
		<rdfs:label>License Document</rdfs:label>
		<rdfs:comment>A legal document giving official permission to do something with a Resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#LicenseDocument-001"/>
		<rdfs:subClassOf rdf:resource="http://purl.org/dc/terms/RightsStatement"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/LinguisticSystem">
		<rdfs:label>Linguistic System</rdfs:label>
		<rdfs:comment>A system of signs, symbols, sounds, gestures, or rules used in communication.</rdfs:comment>
		<dcterms:description>Examples include written, spoken, sign, and computer languages.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#LinguisticSystem-001"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/Location">
		<rdfs:label>Location</rdfs:label>
		<rdfs:comment>A spatial region or named place.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#Location-001"/>
		<rdfs:subClassOf rdf:resource="http://purl.org/dc/terms/LocationPeriodOrJurisdiction"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/LocationPeriodOrJurisdiction">
		<rdfs:label>Location, Period, or Jurisdiction</rdfs:label>
		<rdfs:comment>A location, period of time, or jurisdiction.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#LocationPeriodOrJurisdiction-001"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/MediaType">
		<rdfs:label>Media Type</rdfs:label>
		<rdfs:comment>A file format or physical medium.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#MediaType-001"/>
		<rdfs:subClassOf rdf:resource="http://purl.org/dc/terms/MediaTypeOrExtent"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/MediaTypeOrExtent">
		<rdfs:label>Media Type or Extent</rdfs:label>
		<rdfs:comment>A media type or extent.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#MediaTypeOrExtent-001"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/MethodOfInstruction">
		<rdfs:label>Method of Instruction</rdfs:label>
		<rdfs:comment>A process that is used to engender knowledge, attitudes, and skills.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#MethodOfInstruction-001"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/MethodOfAccrual">
		<rdfs:label>Method of Accrual</rdfs:label>
		<rdfs:comment>A method by which resources are added to a collection.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#MethodOfAccrual-001"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/PeriodOfTime">
		<rdfs:label>Period of Time</rdfs:label>
		<rdfs:comment>An interval of time that is named or defined by its start and end dates.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#PeriodOfTime-001"/>
		<rdfs:subClassOf rdf:resource="http://purl.org/dc/terms/LocationPeriodOrJurisdiction"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/PhysicalMedium">
		<rdfs:label>Physical Medium</rdfs:label>
		<rdfs:comment>A physical material or carrier.</rdfs:comment>
		<dcterms:description>Examples include paper, canvas, or DVD.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#PhysicalMedium-001"/>
		<rdfs:subClassOf rdf:resource="http://purl.org/dc/terms/MediaType"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/PhysicalResource">
		<rdfs:label>Physical Resource</rdfs:label>
		<rdfs:comment>A material thing.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#PhysicalResource-001"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/Policy">
		<rdfs:label>Policy</rdfs:label>
		<rdfs:comment>A plan or course of action by an authority, intended to influence and determine decisions, actions, and other matters.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#Policy-001"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/ProvenanceStatement">
		<rdfs:label>Provenance Statement</rdfs:label>
		<rdfs:comment>A statement of any changes in ownership and custody of a resource since its creation that are significant for its authenticity, integrity, and interpretation.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#ProvenanceStatement-001"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/RightsStatement">
		<rdfs:label>Rights Statement</rdfs:label>
		<rdfs:comment>A statement about the intellectual property rights (IPR) held in or over a Resource, a legal document giving official permission to do something with a resource, or a statement about access rights.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#RightsStatement-001"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/SizeOrDuration">
		<rdfs:label>Size or Duration</rdfs:label>
		<rdfs:comment>A dimension or extent, or a time taken to play or execute.</rdfs:comment>
		<dcterms:description>Examples include a number of pages, a specification of length, width, and breadth, or a period in hours, minutes, and seconds.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#SizeOrDuration-001"/>
		<rdfs:subClassOf rdf:resource="http://purl.org/dc/terms/MediaTypeOrExtent"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/Standard">
		<rdfs:label>Standard</rdfs:label>
		<rdfs:comment>A basis for comparison; a reference point against which other things can be evaluated.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#Standard-001"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/ISO639-2">
		<rdfs:label>ISO 639-2</rdfs:label>
		<rdfs:comment>The three-letter alphabetic codes listed in ISO639-2 for the representation of names of languages.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Datatype"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#ISO639-2-003"/>
		<rdfs:seeAlso rdf:resource="http://lcweb.loc.gov/standards/iso639-2/langhome.html"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/RFC1766">
		<rdfs:label>RFC 1766</rdfs:label>
		<rdfs:comment>The set of tags, constructed according to RFC 1766, for the identification of languages.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Datatype"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#RFC1766-003"/>
		<rdfs:seeAlso rdf:resource="http://www.ietf.org/rfc/rfc1766.txt"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/URI">
		<rdfs:label>URI</rdfs:label>
		<rdfs:comment>The set of identifiers constructed according to the generic syntax for Uniform Resource Identifiers as specified by the Internet Engineering Task Force.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Datatype"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#URI-003"/>
		<rdfs:seeAlso rdf:resource="http://www.ietf.org/rfc/rfc3986.txt"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/Point">
		<rdfs:label>DCMI Point</rdfs:label>
		<rdfs:comment>The set of points in space defined by their geographic coordinates according to the DCMI Point Encoding Scheme.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Datatype"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#Point-003"/>
		<rdfs:seeAlso rdf:resource="http://dublincore.org/documents/dcmi-point/"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/ISO3166">
		<rdfs:label>ISO 3166</rdfs:label>
		<rdfs:comment>The set of codes listed in ISO 3166-1 for the representation of names of countries.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Datatype"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#ISO3166-004"/>
		<rdfs:seeAlso rdf:resource="http://www.iso.org/iso/en/prods-services/iso3166ma/02iso-3166-code-lists/list-en1.html"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/Box">
		<rdfs:label>DCMI Box</rdfs:label>
		<rdfs:comment>The set of regions in space defined by their geographic coordinates according to the DCMI Box Encoding Scheme.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Datatype"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#Box-003"/>
		<rdfs:seeAlso rdf:resource="http://dublincore.org/documents/dcmi-box/"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/Period">
		<rdfs:label>DCMI Period</rdfs:label>
		<rdfs:comment>The set of time intervals defined by their limits according to the DCMI Period Encoding Scheme.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Datatype"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#Period-003"/>
		<rdfs:seeAlso rdf:resource="http://dublincore.org/documents/dcmi-period/"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/W3CDTF">
		<rdfs:label>W3C-DTF</rdfs:label>
		<rdfs:comment>The set of dates and times constructed according to the W3C Date and Time Formats Specification.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Datatype"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#W3CDTF-003"/>
		<rdfs:seeAlso rdf:resource="http://www.w3.org/TR/NOTE-datetime"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/RFC3066">
		<rdfs:label>RFC 3066</rdfs:label>
		<rdfs:comment>The set of tags constructed according to RFC 3066 for the identification of languages.</rdfs:comment>
		<dcterms:description>RFC 3066 has been obsoleted by RFC 4646.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2002-07-13</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Datatype"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#RFC3066-002"/>
		<rdfs:seeAlso rdf:resource="http://www.ietf.org/rfc/rfc3066.txt"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/RFC5646">
		<rdfs:label>RFC 5646</rdfs:label>
		<rdfs:comment>The set of tags constructed according to RFC 5646 for the identification of languages.</rdfs:comment>
		<dcterms:description>RFC 5646 obsoletes RFC 4646.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2010-10-11</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Datatype"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#RFC5646-001"/>
		<rdfs:seeAlso rdf:resource="http://www.ietf.org/rfc/rfc5646.txt"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/RFC4646">
		<rdfs:label>RFC 4646</rdfs:label>
		<rdfs:comment>The set of tags constructed according to RFC 4646 for the identification of languages.</rdfs:comment>
		<dcterms:description>RFC 4646 obsoletes RFC 3066.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Datatype"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#RFC4646-001"/>
		<rdfs:seeAlso rdf:resource="http://www.ietf.org/rfc/rfc4646.txt"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/ISO639-3">
		<rdfs:label>ISO 639-3</rdfs:label>
		<rdfs:comment>The set of three-letter codes listed in ISO 639-3 for the representation of names of languages.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2008-01-14</dcterms:issued>
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Datatype"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#ISO639-3-001"/>
		<rdfs:seeAlso rdf:resource="http://www.sil.org/iso639-3/"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/LCSH">
		<rdfs:label>LCSH</rdfs:label>
		<rdfs:comment>The set of labeled concepts specified by the Library of Congress Subject Headings.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://purl.org/dc/dcam/VocabularyEncodingScheme"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#LCSH-003"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/MESH">
		<rdfs:label>MeSH</rdfs:label>
		<rdfs:comment>The set of labeled concepts specified by the Medical Subject Headings.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://purl.org/dc/dcam/VocabularyEncodingScheme"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#MESH-003"/>
		<rdfs:seeAlso rdf:resource="http://www.nlm.nih.gov/mesh/meshhome.html"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/DDC">
		<rdfs:label>DDC</rdfs:label>
		<rdfs:comment>The set of conceptual resources specified by the Dewey Decimal Classification.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://purl.org/dc/dcam/VocabularyEncodingScheme"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#DDC-003"/>
		<rdfs:seeAlso rdf:resource="http://www.oclc.org/dewey/"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/LCC">
		<rdfs:label>LCC</rdfs:label>
		<rdfs:comment>The set of conceptual resources specified by the Library of Congress Classification.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://purl.org/dc/dcam/VocabularyEncodingScheme"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#LCC-003"/>
		<rdfs:seeAlso rdf:resource="http://lcweb.loc.gov/catdir/cpso/lcco/lcco.html"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/UDC">
		<rdfs:label>UDC</rdfs:label>
		<rdfs:comment>The set of conceptual resources specified by the Universal Decimal Classification.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://purl.org/dc/dcam/VocabularyEncodingScheme"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#UDC-003"/>
		<rdfs:seeAlso rdf:resource="http://www.udcc.org/"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/DCMIType">
		<rdfs:label>DCMI Type Vocabulary</rdfs:label>
		<rdfs:comment>The set of classes specified by the DCMI Type Vocabulary, used to categorize the nature or genre of the resource.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2010-10-11</dcterms:modified>
		<rdf:type rdf:resource="http://purl.org/dc/dcam/VocabularyEncodingScheme"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#DCMIType-003"/>
		<rdfs:seeAlso rdf:resource="http://dublincore.org/documents/dcmi-type-vocabulary/"/>
		<rdfs:seeAlso rdf:resource="http://purl.org/dc/dcmitype/"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/IMT">
		<rdfs:label>IMT</rdfs:label>
		<rdfs:comment>The set of media types specified by the Internet Assigned Numbers Authority.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://purl.org/dc/dcam/VocabularyEncodingScheme"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#IMT-004"/>
		<rdfs:seeAlso rdf:resource="http://www.iana.org/assignments/media-types/"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/TGN">
		<rdfs:label>TGN</rdfs:label>
		<rdfs:comment>The set of places specified by the Getty Thesaurus of Geographic Names.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2000-07-11</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://purl.org/dc/dcam/VocabularyEncodingScheme"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#TGN-003"/>
		<rdfs:seeAlso rdf:resource="http://www.getty.edu/research/tools/vocabulary/tgn/index.html"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/terms/NLM">
		<rdfs:label>NLM</rdfs:label>
		<rdfs:comment>The set of conceptual resources specified by the National Library of Medicine Classification.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/dc/terms/"/>
		<dcterms:issued>2005-06-13</dcterms:issued>
		<dcterms:modified>2008-01-14</dcterms:modified>
		<rdf:type rdf:resource="http://purl.org/dc/dcam/VocabularyEncodingScheme"/>
		<dcterms:hasVersion rdf:resource="http://dublincore.org/usage/terms/history/#NLM-002"/>
		<rdfs:seeAlso rdf:resource="http://wwwcf.nlm.nih.gov/class/"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/Project">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:subClassOf rdf:nodeID="arc7179b3"/>
		<rdfs:subClassOf rdf:nodeID="arc7179b4"/>
		<rdfs:subClassOf rdf:nodeID="arc7179b5"/>
		<rdfs:subClassOf rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#Thing"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b43"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b44"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b45"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b46"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b47"/>
		<rdfs:label>Project</rdfs:label>
		<rdfs:comment>A project (a collective endeavour of some kind).</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://xmlns.com/foaf/0.1/"/>
		<sw-vocab-status:nsterm_status>unstable</sw-vocab-status:nsterm_status>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arc7179b3">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.utwente.nl/ns/escape-projects.owl#startDate"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-projects.owl#startDate">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Start date</rdfs:label>
		<rdfs:subPropertyOf rdf:resource="http://purl.utwente.nl/ns/escape-projects.owl#date"/>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arc7179b4">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.utwente.nl/ns/escape-projects.owl#endDate"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-projects.owl#endDate">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>End date</rdfs:label>
		<rdfs:subPropertyOf rdf:resource="http://purl.utwente.nl/ns/escape-projects.owl#date"/>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arc7179b5">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.utwente.nl/ns/escape-projects.owl#outcomeDocument"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-projects.owl#outcomeDocument">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Outcome document</rdfs:label>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Project"/>
		<rdfs:range rdf:resource="http://xmlns.com/foaf/0.1/Document"/>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-projects.owl#isOutcomeDocumentOf"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-projects.owl#isAbout">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Is about</rdfs:label>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Project"/>
		<rdfs:range rdf:resource="http://purl.utwente.nl/ns/escape-projects.owl#Topic"/>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-projects.owl#dealtWithin"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-projects.owl#isOutcomeDocumentOf">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Is outcome document of</rdfs:label>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Document"/>
		<rdfs:range rdf:resource="http://xmlns.com/foaf/0.1/Project"/>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-projects.owl#outcomeDocument"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-projects.owl#worksOn">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Works on</rdfs:label>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Person"/>
		<rdfs:range rdf:resource="http://purl.utwente.nl/ns/escape-projects.owl#Topic"/>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-projects.owl#isWorkedOnBy"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-projects.owl#date">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Date</rdfs:label>
		<rdfs:range rdf:resource="http://www.w3.org/2001/XMLSchema#date"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-annotations.owl">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Ontology"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.w3.org/2000/01/rdf-schema#Resource">
		<rdf:type rdf:resource="http://www.w3.org/2000/01/rdf-schema#Class"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-annotations.owl#RelationAnnotation">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemClass"/>
		<rdfs:subClassOf rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#Statement"/>
		<rdfs:subClassOf rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#Thing"/>
		<rdfs:subClassOf rdf:nodeID="arcb7c0b1"/>
		<rdfs:label>Relation annotation</rdfs:label>
		<rdfs:comment>Extra information associated with a particular relationship to describe or explain the content of the relationship, or to comment on it</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-annotations.owl#predicateOf">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
		<rdfs:domain rdf:resource="http://www.w3.org/2000/01/rdf-schema#Resource"/>
		<rdfs:range rdf:resource="http://purl.utwente.nl/ns/escape-annotations.owl#RelationAnnotation"/>
		<rdfs:label>Predicate of</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-annotations.owl#predicate"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-annotations.owl#object">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-annotations.owl#objectOf"/>
		<rdfs:label>Object</rdfs:label>
		<rdfs:subPropertyOf rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#object"/>
		<rdfs:range rdf:resource="http://www.w3.org/2000/01/rdf-schema#Resource"/>
		<rdfs:domain rdf:resource="http://purl.utwente.nl/ns/escape-annotations.owl#RelationAnnotation"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-annotations.owl#objectOf">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
		<rdfs:domain rdf:resource="http://www.w3.org/2000/01/rdf-schema#Resource"/>
		<rdfs:label>Object of</rdfs:label>
		<rdfs:range rdf:resource="http://purl.utwente.nl/ns/escape-annotations.owl#RelationAnnotation"/>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-annotations.owl#object"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-annotations.owl#subjectOf">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
		<rdfs:label>Subject of</rdfs:label>
		<rdfs:domain rdf:resource="http://www.w3.org/2000/01/rdf-schema#Resource"/>
		<rdfs:range rdf:resource="http://purl.utwente.nl/ns/escape-annotations.owl#RelationAnnotation"/>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-annotations.owl#subject"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-annotations.owl#subject">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
		<rdfs:domain rdf:resource="http://purl.utwente.nl/ns/escape-annotations.owl#RelationAnnotation"/>
		<rdfs:range rdf:resource="http://www.w3.org/2000/01/rdf-schema#Resource"/>
		<rdfs:label>Object</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-annotations.owl#subjectOf"/>
		<rdfs:subPropertyOf rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#subject"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-annotations.owl#predicate">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-annotations.owl#predicateOf"/>
		<rdfs:domain rdf:resource="http://purl.utwente.nl/ns/escape-annotations.owl#RelationAnnotation"/>
		<rdfs:range rdf:resource="http://www.w3.org/2000/01/rdf-schema#Resource"/>
		<rdfs:label>Object</rdfs:label>
		<rdfs:subPropertyOf rdf:resource="http://www.w3.org/1999/02/22-rdf-syntax-ns#predicate"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-annotations.owl#comment">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Comment</rdfs:label>
		<rdfs:comment>A note of explanation or comment about an object</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.openarchives.org/ore/terms/aggregates">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
		<rdfs:label>Aggregates</rdfs:label>
		<owl:inverseOf rdf:resource="http://www.openarchives.org/ore/terms/isAggregatedBy"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.openarchives.org/ore/terms/isAggregatedBy">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
		<rdfs:label>Aggregated by</rdfs:label>
		<owl:inverseOf rdf:resource="http://www.openarchives.org/ore/terms/aggregates"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.openarchives.org/ore/terms/Aggregation">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:label>Aggregation</rdfs:label>
		<escape-system:hasTitleProperty rdf:resource="http://xmlns.com/foaf/0.1/name"/>
		<escape-system:hasTitleProperty rdf:resource="http://purl.org/dc/terms/title"/>
		<rdfs:subClassOf rdf:nodeID="arc7cb4b1"/>
		<rdfs:subClassOf rdf:nodeID="arc7cb4b2"/>
		<rdfs:subClassOf rdf:nodeID="arc7cb4b3"/>
		<rdfs:subClassOf rdf:nodeID="arc7cb4b4"/>
		<rdfs:subClassOf rdf:nodeID="arc7cb4b5"/>
		<rdfs:subClassOf rdf:nodeID="arc7cb4b6"/>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arc7cb4b1">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.org/dc/terms/title"/>
		<owl:minCardinality>1</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arc7cb4b2">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.org/dc/terms/creator"/>
		<owl:minCardinality>1</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arc7cb4b3">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.org/dc/terms/description"/>
		<owl:minCardinality>1</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arc7cb4b4">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.org/dc/terms/rights"/>
		<owl:minCardinality>1</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arc7cb4b5">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.org/dc/terms/rightsHolder"/>
		<owl:minCardinality>1</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arc7cb4b6">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#template"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcb7c0b1">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.org/dc/terms/description"/>
		<owl:minCardinality>1</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-annotations.owl#title">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
		<rdfs:label>Title</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/dc/dcmitype/MovingImage">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:label>Video</rdfs:label>
		<rdfs:subClassOf rdf:resource="http://xmlns.com/foaf/0.1/Document"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://swrc.ontoware.org/ontology#status">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Status</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://swrc.ontoware.org/ontology#startDate">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Start date</rdfs:label>
		<rdfs:range rdf:resource="http://www.w3.org/2001/XMLSchema#date"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-system.owl#mailtoURL">
		<rdfs:subClassOf rdf:resource="http://www.w3.org/2001/XMLSchema#anyURI"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-system.owl#telURL">
		<rdfs:subClassOf rdf:resource="http://www.w3.org/2001/XMLSchema#anyURI"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-system.owl#imageURL">
		<rdfs:subClassOf rdf:resource="http://www.w3.org/2001/XMLSchema#anyURI"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-system.owl#schemaResourceURI">
		<rdfs:subClassOf rdf:resource="http://www.w3.org/2001/XMLSchema#anyURI"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-system.owl#HiddenProperty">
		<rdfs:subClassOf rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty">
		<rdfs:subClassOf rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#HiddenProperty"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-system.owl#attachmentFileName">
		<rdfs:label>Attachment file name</rdfs:label>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-system.owl#template">
		<rdfs:label>Template</rdfs:label>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#HiddenProperty"/>
	</rdf:Description>

	<rdf:Description rdf:about="info:fedora/fedora-system:def/view#disseminates">
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
	</rdf:Description>

	<rdf:Description rdf:about="info:fedora/fedora-system:def/model#hasModel">
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
	</rdf:Description>

	<rdf:Description rdf:about="info:fedora/fedora-system:def/relations-external#isMetadataFor">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#InverseFunctionalProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#HiddenProperty"/>
		<rdfs:label>URL</rdfs:label>
		<rdfs:range rdf:resource="http://www.w3.org/2001/XMLSchema#anyURI"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-system.owl#externalUri">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#InverseFunctionalProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#HiddenProperty"/>
		<rdfs:label>URL</rdfs:label>
		<rdfs:range rdf:resource="http://www.w3.org/2001/XMLSchema#anyURI"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-system.owl#resourceUri">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#InverseFunctionalProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
		<rdfs:label>Resource URL</rdfs:label>
		<rdfs:range rdf:resource="http://www.w3.org/2001/XMLSchema#anyURI"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.w3.org/1999/02/22-rdf-syntax-ns#type">
		<rdfs:label>Type</rdfs:label>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-system.owl#systemRole">
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-system.owl#owner">
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-system.owl#editor">
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-system.owl#createdBy">
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-system.owl#lastModifiedBy">
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-system.owl#creationDate">
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-system.owl#modificationDate">
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemProperty"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-system.owl#Thing">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#SystemClass"/>
		<rdfs:label>ESCAPE Thing</rdfs:label>
		<escape-system:hasTitleProperty rdf:resource="http://xmlns.com/foaf/0.1/name"/>
		<escape-system:hasTitleProperty rdf:resource="http://purl.org/dc/terms/title"/>
		<escape-system:hasShortViewProperty rdf:resource="http://purl.org/dc/terms/source"/>
		<rdfs:subClassOf rdf:nodeID="arca3b9b1"/>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arca3b9b1">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.utwente.nl/ns/escape-annotations.owl#comment"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.w3.org/2002/07/owl#Thing">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.w3.org/2004/02/skos/core#Concept">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:label>Concept</rdfs:label>
		<escape-system:hasTitleProperty rdf:resource="http://www.w3.org/2004/02/skos/core#prefLabel"/>
		<rdfs:subClassOf rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#Thing"/>
		<rdfs:subClassOf rdf:nodeID="arcfb5fb1"/>
		<rdfs:subClassOf rdf:nodeID="arcfb5fb2"/>
		<rdfs:subClassOf rdf:nodeID="arcfb5fb3"/>
		<rdfs:subClassOf rdf:nodeID="arcfb5fb4"/>
		<rdfs:subClassOf rdf:nodeID="arcfb5fb5"/>
		<rdfs:subClassOf rdf:nodeID="arcfb5fb6"/>
		<rdfs:subClassOf rdf:nodeID="arcfb5fb7"/>
		<rdfs:subClassOf rdf:nodeID="arcfb5fb8"/>
		<rdfs:subClassOf rdf:nodeID="arcfb5fb9"/>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcfb5fb1">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://www.w3.org/2004/02/skos/core#notation"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcfb5fb2">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://www.w3.org/2004/02/skos/core#prefLabel"/>
		<owl:cardinality>1</owl:cardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcfb5fb3">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://www.w3.org/2004/02/skos/core#altLabel"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcfb5fb4">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://www.w3.org/2004/02/skos/core#note"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcfb5fb5">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://www.w3.org/2004/02/skos/core#definition"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcfb5fb6">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://www.w3.org/2004/02/skos/core#example"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcfb5fb7">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://www.w3.org/2004/02/skos/core#broader"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcfb5fb8">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://www.w3.org/2004/02/skos/core#narrower"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcfb5fb9">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://www.w3.org/2004/02/skos/core#related"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.w3.org/2004/02/skos/core#notation">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Notation</rdfs:label>
		<rdfs:comment>A notation, also known as classification code, is a string of characters such as &quot;T58.5&quot; or &quot;303.4833&quot; used to uniquely identify a concept within the scope of a given concept scheme.</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.w3.org/2004/02/skos/core#prefLabel">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Label</rdfs:label>
		<rdfs:comment>The preferred lexical label for a resource.</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.w3.org/2004/02/skos/core#altLabel">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Alternative label</rdfs:label>
		<rdfs:comment>An alternative lexical label for a resource.</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.w3.org/2004/02/skos/core#note">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Note</rdfs:label>
		<rdfs:comment>A general note, for any purpose.</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.w3.org/2004/02/skos/core#scopeNote">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Scope note</rdfs:label>
		<rdfs:comment>A note that helps to clarify the meaning and/or the use of a concept.</rdfs:comment>
		<rdfs:subPropertyOf rdf:resource="http://www.w3.org/2004/02/skos/core#note"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.w3.org/2004/02/skos/core#historyNote">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>History note</rdfs:label>
		<rdfs:comment>A note about the past state/use/meaning of a concept.</rdfs:comment>
		<rdfs:subPropertyOf rdf:resource="http://www.w3.org/2004/02/skos/core#note"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.w3.org/2004/02/skos/core#definition">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Definition</rdfs:label>
		<rdfs:comment>A statement or formal explanation of the meaning of a concept.</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.w3.org/2004/02/skos/core#example">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Example</rdfs:label>
		<rdfs:comment>An example of the use of a concept.</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.w3.org/2004/02/skos/core#broader">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Has broader</rdfs:label>
		<rdfs:comment>Relates a concept to a concept that is more general in meaning.</rdfs:comment>
		<owl:inverseOf rdf:resource="http://www.w3.org/2004/02/skos/core#narrower"/>
		<rdfs:range rdf:resource="http://www.w3.org/2004/02/skos/core#Concept"/>
		<rdfs:domain rdf:resource="http://www.w3.org/2004/02/skos/core#Concept"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.w3.org/2004/02/skos/core#narrower">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Has narrower</rdfs:label>
		<rdfs:comment>Relates a concept to a concept that is more specific in meaning.</rdfs:comment>
		<owl:inverseOf rdf:resource="http://www.w3.org/2004/02/skos/core#broader"/>
		<rdfs:range rdf:resource="http://www.w3.org/2004/02/skos/core#Concept"/>
		<rdfs:domain rdf:resource="http://www.w3.org/2004/02/skos/core#Concept"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.w3.org/2004/02/skos/core#related">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Has related</rdfs:label>
		<rdfs:comment>Relates a concept to a concept with which there is an associative semantic relationship.</rdfs:comment>
		<rdfs:range rdf:resource="http://www.w3.org/2004/02/skos/core#Concept"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/birthday">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Birthday</rdfs:label>
		<rdfs:range rdf:resource="http://www.w3.org/2001/XMLSchema#date"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/name">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Name</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/firstName">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>First name</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/geekcode">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Geek code</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/gender">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Gender</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/meyersBriggs">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Myers briggs</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/givenname">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Given name</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/family_name">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Family name</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/surname">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Surname</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/nick">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Nick name</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/aimChatID">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Aim chat ID</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/icqChatID">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>ICQ chat ID</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/jabberID">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Jabber ID</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/msnChatID">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>MSN chat ID</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/yahooChatID">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Yahoo chat ID</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/plan">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Plan</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/title">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Title</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/phone">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Phone</rdfs:label>
		<rdfs:range rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#telURL"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/page">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Page</rdfs:label>
		<rdfs:range rdf:resource="http://www.w3.org/2001/XMLSchema#anyURI"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/homepage">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Home page</rdfs:label>
		<rdfs:range rdf:resource="http://www.w3.org/2001/XMLSchema#anyURI"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/tipjar">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Tip jar</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/weblog">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Web log</rdfs:label>
		<rdfs:range rdf:resource="http://www.w3.org/2001/XMLSchema#anyURI"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/workInfoHomepage">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Personal homepage (work)</rdfs:label>
		<rdfs:range rdf:resource="http://www.w3.org/2001/XMLSchema#anyURI"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/mbox">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>E-mail</rdfs:label>
		<rdfs:range rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#mailtoURL"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/thumbnail">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#DatatypeProperty"/>
		<rdfs:label>Thumbnail</rdfs:label>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/currentProject">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Has current project</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#isCurrentProjectOf"/>
		<rdfs:range rdf:resource="http://xmlns.com/foaf/0.1/Project"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#isCurrentProjectOf">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Is current project of</rdfs:label>
		<owl:inverseOf rdf:resource="http://xmlns.com/foaf/0.1/currentProject"/>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Project"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/depiction">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Depiction</rdfs:label>
		<owl:inverseOf rdf:resource="http://xmlns.com/foaf/0.1/depicts"/>
		<rdfs:range rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#imageURL"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/depicts">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Depicts</rdfs:label>
		<owl:inverseOf rdf:resource="http://xmlns.com/foaf/0.1/depiction"/>
		<rdfs:domain rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#imageURL"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/img">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Image</rdfs:label>
		<rdfs:subPropertyOf rdf:resource="http://xmlns.com/foaf/0.1/depiction"/>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#imgOf"/>
		<rdfs:range rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#imageURL"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#imgOf">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Image of</rdfs:label>
		<rdfs:subPropertyOf rdf:resource="http://xmlns.com/foaf/0.1/depicts"/>
		<owl:inverseOf rdf:resource="http://xmlns.com/foaf/0.1/img"/>
		<rdfs:domain rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#imageURL"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/fundedBy">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Funded by</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#funds"/>
		<rdfs:range rdf:resource="http://xmlns.com/foaf/0.1/Agent"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#funds">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Funds</rdfs:label>
		<owl:inverseOf rdf:resource="http://xmlns.com/foaf/0.1/fundedBy"/>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Agent"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/interest">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Interested in</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#interestOf"/>
		<rdfs:range rdf:resource="http://xmlns.com/foaf/0.1/Document"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#interestOf">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Is interest of</rdfs:label>
		<owl:inverseOf rdf:resource="http://xmlns.com/foaf/0.1/interest"/>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Document"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/isPrimaryTopicOf">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Is primary topic of</rdfs:label>
		<owl:inverseOf rdf:resource="http://xmlns.com/foaf/0.1/primaryTopic"/>
		<rdfs:range rdf:resource="http://xmlns.com/foaf/0.1/Document"/>
		<rdfs:domain rdf:resource="http://purl.utwente.nl/ns/escape-projects.owl#Topic"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/primaryTopic">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Has primary topic</rdfs:label>
		<owl:inverseOf rdf:resource="http://xmlns.com/foaf/0.1/isPrimaryTopicOf"/>
		<rdfs:range rdf:resource="http://purl.utwente.nl/ns/escape-projects.owl#Topic"/>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Document"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/knows">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#SymmetricProperty"/>
		<rdfs:label>Knows</rdfs:label>
		<rdfs:range rdf:resource="http://xmlns.com/foaf/0.1/Agent"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/logo">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Logo</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#logoOf"/>
		<rdfs:range rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#imageURL"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#logoOf">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Is logo of</rdfs:label>
		<owl:inverseOf rdf:resource="http://xmlns.com/foaf/0.1/logo"/>
		<rdfs:domain rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#imageURL"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/made">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Made</rdfs:label>
		<owl:inverseOf rdf:resource="http://xmlns.com/foaf/0.1/maker"/>
		<rdfs:range rdf:resource="http://xmlns.com/foaf/0.1/Document"/>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Agent"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/maker">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Made by</rdfs:label>
		<owl:inverseOf rdf:resource="http://xmlns.com/foaf/0.1/made"/>
		<rdfs:range rdf:resource="http://xmlns.com/foaf/0.1/Agent"/>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Document"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/member">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Has member</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#isMemberOf"/>
		<rdfs:range rdf:resource="http://xmlns.com/foaf/0.1/Agent"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#isMemberOf">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Is member of</rdfs:label>
		<owl:inverseOf rdf:resource="http://xmlns.com/foaf/0.1/member"/>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Agent"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/pastProject">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Has past project</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#isPastProjectOf"/>
		<rdfs:range rdf:resource="http://xmlns.com/foaf/0.1/Project"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#isPastProjectOf">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Is past project of</rdfs:label>
		<owl:inverseOf rdf:resource="http://xmlns.com/foaf/0.1/pastProject"/>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Project"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/publications">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Publication</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#isPublicationOf"/>
		<rdfs:range rdf:resource="http://xmlns.com/foaf/0.1/Document"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#isPublicationOf">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Publication of</rdfs:label>
		<owl:inverseOf rdf:resource="http://xmlns.com/foaf/0.1/publications"/>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Document"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/schoolHomepage">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Alumnus of</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#hadStudent"/>
		<rdfs:range rdf:resource="http://xmlns.com/foaf/0.1/Organization"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#hadStudent">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Almunus</rdfs:label>
		<owl:inverseOf rdf:resource="http://xmlns.com/foaf/0.1/schoolHomepage"/>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Organization"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/topic">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Topic</rdfs:label>
		<rdfs:comment>Relates a document to a thing that the document is about.</rdfs:comment>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#topicIn"/>
		<rdfs:range rdf:resource="http://purl.utwente.nl/ns/escape-projects.owl#Topic"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#topicIn">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Topic in</rdfs:label>
		<owl:inverseOf rdf:resource="http://xmlns.com/foaf/0.1/topic"/>
		<rdfs:domain rdf:resource="http://purl.utwente.nl/ns/escape-projects.owl#Topic"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/topic_interest">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Topic interest</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#topic_interstOf"/>
		<rdfs:range rdf:resource="http://purl.utwente.nl/ns/escape-projects.owl#Topic"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#topic_interstOf">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Is topic interest of</rdfs:label>
		<owl:inverseOf rdf:resource="http://xmlns.com/foaf/0.1/topic_interest"/>
		<rdfs:domain rdf:resource="http://purl.utwente.nl/ns/escape-projects.owl#Topic"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/workplaceHomepage">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Works at</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.utwente.nl/ns/escape-display.owl#hasEmployee"/>
		<rdfs:range rdf:resource="http://xmlns.com/foaf/0.1/Organization"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-display.owl#hasEmployee">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Has employee</rdfs:label>
		<owl:inverseOf rdf:resource="http://xmlns.com/foaf/0.1/workplaceHomepage"/>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Organization"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/Agent">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:label>Agent</rdfs:label>
		<owl:disjointWith rdf:resource="http://xmlns.com/foaf/0.1/Document"/>
		<owl:disjointWith rdf:resource="http://xmlns.com/foaf/0.1/OnlineAccount"/>
		<owl:disjointWith rdf:resource="http://xmlns.com/foaf/0.1/Project"/>
		<rdfs:comment>An agent (eg. person, group, software or physical artifact).</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://xmlns.com/foaf/0.1/"/>
		<sw-vocab-status:nsterm_status>unstable</sw-vocab-status:nsterm_status>
		<rdfs:subClassOf rdf:nodeID="arcf468b1"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b2"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b3"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b4"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b5"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b6"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b7"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b8"/>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b1">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/name"/>
		<owl:minCardinality>1</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b2">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/phone"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b3">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/page"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b4">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/mbox"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b5">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/made"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b6">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/logo"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b7">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/depiction"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b8">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.org/dc/terms/identifier"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/Document">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:label>Document</rdfs:label>
		<owl:disjointWith rdf:resource="http://xmlns.com/foaf/0.1/OnlineAccount"/>
		<owl:disjointWith rdf:resource="http://xmlns.com/foaf/0.1/Project"/>
		<rdfs:comment>A document.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://xmlns.com/foaf/0.1/"/>
		<sw-vocab-status:nsterm_status>testing</sw-vocab-status:nsterm_status>
		<rdfs:subClassOf rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#Thing"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b9"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b10"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b11"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b12"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b13"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b14"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b15"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b16"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b17"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b18"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b19"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b20"/>
		<escape-system:hasTitleProperty rdf:resource="http://purl.org/dc/terms/title"/>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b9">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.org/dc/terms/title"/>
		<owl:minCardinality>1</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b10">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.org/dc/terms/description"/>
		<owl:minCardinality>1</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b11">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.org/dc/terms/date"/>
		<owl:minCardinality>1</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b12">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/maker"/>
		<owl:minCardinality>1</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b13">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/topic"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b14">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.org/dc/terms/source"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b15">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.org/dc/terms/subject"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b16">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/relatedTo"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b17">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/page"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b18">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/depiction"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b19">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.org/dc/terms/rights"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b20">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://purl.org/dc/terms/rightsHolder"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/Group">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:label>Group</rdfs:label>
		<rdfs:subClassOf rdf:resource="http://xmlns.com/foaf/0.1/Agent"/>
		<rdfs:subClassOf rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#Thing"/>
		<owl:disjointWith rdf:resource="http://xmlns.com/foaf/0.1/Organization"/>
		<owl:disjointWith rdf:resource="http://xmlns.com/foaf/0.1/Person"/>
		<rdfs:comment>A class of Agents.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://xmlns.com/foaf/0.1/"/>
		<sw-vocab-status:nsterm_status>unstable</sw-vocab-status:nsterm_status>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/Image">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:label>Image</rdfs:label>
		<rdfs:subClassOf rdf:resource="http://xmlns.com/foaf/0.1/Document"/>
		<owl:disjointWith rdf:resource="http://xmlns.com/foaf/0.1/PersonalProfileDocument"/>
		<rdfs:comment>An image.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://xmlns.com/foaf/0.1/"/>
		<sw-vocab-status:nsterm_status>testing</sw-vocab-status:nsterm_status>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/OnlineAccount">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:label>OnlineAccount</rdfs:label>
		<owl:disjointWith rdf:resource="http://xmlns.com/foaf/0.1/Project"/>
		<rdfs:comment>An online account.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://xmlns.com/foaf/0.1/"/>
		<sw-vocab-status:nsterm_status>unstable</sw-vocab-status:nsterm_status>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/Organization">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:label>Organization</rdfs:label>
		<rdfs:subClassOf rdf:resource="http://xmlns.com/foaf/0.1/Agent"/>
		<rdfs:subClassOf rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#Thing"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b21"/>
		<owl:disjointWith rdf:resource="http://xmlns.com/foaf/0.1/Person"/>
		<rdfs:comment>An organization.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://xmlns.com/foaf/0.1/"/>
		<sw-vocab-status:nsterm_status>unstable</sw-vocab-status:nsterm_status>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b21">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/member"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/Person">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:label>Person</rdfs:label>
		<rdfs:subClassOf rdf:resource="http://xmlns.com/foaf/0.1/Agent"/>
		<rdfs:subClassOf rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#Thing"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b22"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b23"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b24"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b25"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b26"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b27"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b28"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b29"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b30"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b31"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b32"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b33"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b34"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b35"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b36"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b37"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b38"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b39"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b40"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b41"/>
		<rdfs:subClassOf rdf:nodeID="arcf468b42"/>
		<rdfs:comment>A person.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://xmlns.com/foaf/0.1/"/>
		<sw-vocab-status:nsterm_status>stable</sw-vocab-status:nsterm_status>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b22">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/birthday"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b23">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/family_name"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b24">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/firstName"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b25">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/geekcode"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b26">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/gender"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b27">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/givenname"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b28">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/meyersBriggs"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b29">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/nick"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b30">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/plan"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b31">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/surname"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b32">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/title"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b33">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/currentProject"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b34">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/interest"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b35">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/knows"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b36">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/logo"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b37">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/pastProject"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b38">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/publications"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b39">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/schoolHomepage"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b40">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/topic_interest"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b41">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/workInfoHomepage"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b42">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/workplaceHomepage"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:about="http://xmlns.com/foaf/0.1/PersonalProfileDocument">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:label>Personal profile document</rdfs:label>
		<rdfs:subClassOf rdf:resource="http://xmlns.com/foaf/0.1/Document"/>
		<rdfs:comment>A personal profile RDF document.</rdfs:comment>
		<rdfs:isDefinedBy rdf:resource="http://xmlns.com/foaf/0.1/"/>
		<sw-vocab-status:nsterm_status>testing</sw-vocab-status:nsterm_status>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b43">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/name"/>
		<owl:minCardinality>1</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b44">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/depiction"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b45">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/fundedBy"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b46">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/logo"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arcf468b47">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/page"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-discourserelationships.owl">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Ontology"/>
		<owl:imports rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourserelationships.owl"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.utwente.nl/ns/escape-discourserelationships.owl#appliedIn">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Applied in</rdfs:label>
		<rdfs:subPropertyOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/discourse-relationships/refersTo"/>
		<rdfs:comment>Something (a result for example) is applied in the other entity</rdfs:comment>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arc590ab1">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/name"/>
		<owl:minCardinality>1</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arc590ab2">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/depiction"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arc590ab3">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/logo"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>

	<rdf:Description rdf:nodeID="arc590ab4">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Restriction"/>
		<owl:onProperty rdf:resource="http://xmlns.com/foaf/0.1/page"/>
		<owl:minCardinality>0</owl:minCardinality>
	</rdf:Description>


	<!-- imported namespaces -->
	<rdf:Description rdf:about="http://www.medsci.ox.ac.uk/vocab/researchers/0.1/">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Ontology"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://www.medsci.ox.ac.uk/vocab/researchers/0.1/Researcher">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:subClassOf rdf:resource="http://xmlns.com/foaf/0.1/Person"/>
		<rdfs:label xml:lang="en">Researcher</rdfs:label>
		<rdfs:comment xml:lang="en">A person who is an academic researcher.</rdfs:comment>
		<rdfs:isdefinedby rdf:resource="http://www.medsci.ox.ac.uk/vocab/researchers/0.1/" />
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/spar/biro/references">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>References</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.org/spar/biro/isReferencedBy"/>
		<rdfs:range rdf:resource="http://xmlns.com/foaf/0.1/Document"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/spar/biro/isReferencedBy">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Is Referenced By</rdfs:label>
		<owl:inverseOf rdf:resource="http://purl.org/spar/biro/references"/>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Document"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/pav">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Ontology"/>
	</rdf:Description>
	
	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/pav/editedBy">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Edited By</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/pav"/>
		<owl:inverseOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/pav/editors"/>
		<rdfs:range rdf:resource="http://xmlns.com/foaf/0.1/Agent"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/pav/editors">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Editor Of</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/pav"/>
		<owl:inverseOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/pav/editedBy"/>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Agent"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/pav/authoredBy">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Authored By</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/pav"/>
		<owl:inverseOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/pav/authors"/>
		<rdfs:range rdf:resource="http://xmlns.com/foaf/0.1/Agent"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/pav/authors">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Author Of</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/pav"/>
		<owl:inverseOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/pav/authoredBy"/>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Agent"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/pav/contributors">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Contributors</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/pav"/>
		<owl:inverseOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/pav/contributedBy"/>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Agent"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/pav/contributedBy">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Contributor of</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/pav"/>
		<owl:inverseOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/pav/contributors"/>
		<rdfs:domain rdf:resource="http://xmlns.com/foaf/0.1/Agent"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/pav/publisher">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Is Publisher Of</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/pav"/>
		<owl:inverseOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/pav/publishedBy"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://swan.mindinformatics.org/ontologies/1.2/pav/publishedBy">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Is Published By</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/pav"/>
		<owl:inverseOf rdf:resource="http://swan.mindinformatics.org/ontologies/1.2/pav/publisher"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/vocab/frbr/core">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Ontology"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/vocab/frbr/core#Expression">
		<rdfs:label>Publication</rdfs:label>
		<dcterms:description>A class whose members are a realization of a single work usually in a physical form. This class corresponds to the FRBR group one entity 'Expression'.</dcterms:description>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/vocab/frbr/core"/>
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/vocab/frbr/core#part">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdfs:label>Has Parts</rdfs:label>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/vocab/frbr/core"/>
		<owl:inverseOf rdf:resource="http://purl.org/vocab/frbr/core#partOf"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/vocab/frbr/core#partOf">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Is Part Of</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/vocab/frbr/core"/>
		<owl:inverseOf rdf:resource="http://purl.org/vocab/frbr/core#part"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/vocab/frbr/core#relatedEndeavour">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#ObjectProperty"/>
		<rdf:type rdf:resource="http://purl.utwente.nl/ns/escape-system.owl#NonAssignableProperty"/>
		<rdfs:label>Related To</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/vocab/frbr/core"/>
	</rdf:Description>
	

	<!-- fabio stuff -->
	<rdf:Description rdf:about="http://purl.org/spar/fabio">
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Ontology"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/spar/fabio/Book">
		<rdfs:label>Book</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/spar/fabio"/>
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<!--<rdfs:subClassOf rdf:resource="http://purl.org/vocab/frbr/core#Expression"/>-->
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/spar/fabio/ConferencePaper">
		<rdfs:label>Conference Paper</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/spar/fabio"/>
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:subClassOf rdf:resource="http://purl.org/vocab/frbr/core#Expression"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/spar/fabio/WebPage">
		<rdfs:label>Web Page</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/spar/fabio"/>
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:subClassOf rdf:resource="http://purl.org/vocab/frbr/core#Expression"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/spar/fabio/WebSite">
		<rdfs:label>Web Site</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/spar/fabio"/>
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/spar/fabio/ReportDocument">
		<rdfs:label>Report Document</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/spar/fabio"/>
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:subClassOf rdf:resource="http://purl.org/vocab/frbr/core#Expression"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/spar/fabio/JournalArticle">
		<rdfs:label>Journal Article</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/spar/fabio"/>
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:subClassOf rdf:resource="http://purl.org/vocab/frbr/core#Expression"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/spar/fabio/BookChapter">
		<rdfs:label>Book Chapter</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/spar/fabio"/>
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/spar/fabio/Presentation">
		<rdfs:label>Presentation</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/spar/fabio"/>
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:subClassOf rdf:resource="http://purl.org/vocab/frbr/core#Expression"/>
	</rdf:Description>

	<rdf:Description rdf:about="http://purl.org/spar/fabio/MovingImage">
		<rdfs:label>Video Recording</rdfs:label>
		<rdfs:isDefinedBy rdf:resource="http://purl.org/spar/fabio"/>
		<rdf:type rdf:resource="http://www.w3.org/2002/07/owl#Class"/>
		<rdfs:subClassOf rdf:resource="http://purl.org/vocab/frbr/core#Expression"/>
	</rdf:Description>

</rdf:RDF>