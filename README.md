# CustomElement

Plugin pour Dotclear 2 implémentant des éléments HTML personnalisés

## Éléments disponibles

### Dernière version disponible du canal stable

```html
<dotclear-release-stable-version>dernière version</dotclear-release-stable-version>
```

Le texte « dernière version » sera masqué et remplacé par la dernière version disponible du canal stable.

Insertion selon la syntaxe utilisée :

- Wiki :

    ```wiki
    ``<dotclear-release-stable-version></dotclear-release-stable-version>``
    ```

- Markdown (directement, pas besoin d'autre chose) :

    ```markdown
    <dotclear-release-stable-version></dotclear-release-stable-version>
    ```

- HTML : idem Markdown sauf que les éditeurs peuvent avoir un nettoyage agressif et virer tout ce qu'ils ne connaissent pas, donc mode source à minima (à vérifier)

Quand ça fonctionne bien le code source dans la page ressemble à ça (inspecté avec les devtools) :

```html
<dotclear-release-stable-version>
  #shadow-root (open)
    <span>2.35</span>
</dotclear-release-stable-version>
```

### Version de PHP minimum pour la dernière version du canal stable

```html
<dotclear-release-stable-phpmin>8.?</dotclear-release-stable-phpmin>
```

Le texte « 8.? » sera masqué et remplacé par la version minimale requise de PHP pour la dernière version disponible du canal stable.

Insertion selon la syntaxe utilisée :

- Wiki :

    ```wiki
    ``<dotclear-release-stable-phpmin></dotclear-release-stable-phpmin>``
    ```

- Markdown (directement, pas besoin d'autre chose) :

    ```markdown
    <dotclear-release-stable-phpmin></dotclear-release-stable-phpmin>
    ```

- HTML : idem Markdown sauf que les éditeurs peuvent avoir un nettoyage agressif et virer tout ce qu'ils ne connaissent pas, donc mode source à minima (à vérifier)

Quand ça fonctionne bien le code source dans la page ressemble à ça (inspecté avec les devtools) :

```html
<dotclear-release-stable-phpmin>
  #shadow-root (open)
    <span>8.1</span>
</dotclear-release-stable-phpmin>
```

## Réglages

Attention !

Si l'option `enable_html_filter` est à `true` (about:config > system) les éléments personnalisés seront supprimés du contenu avant affichage.

Il est recommandé de désactiver cette option si elle est active.
